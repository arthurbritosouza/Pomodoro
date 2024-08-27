var sec = 0;
var secFoco = 0;
var secDescanso = 0;
var min = 0;
var minDescanso = 0;
var minFoco = 0;
var interval_completo;
var interval_foco;
var interval_descanso;
var temp_completo;
var foco;
var descanso;
var minSave;
var minSaveFoco;
var minSaveDescanso;
var secSave;
var secSaveFoco;
var secSaveDescanso;
var isStarted = false;
var isStopped = false;
var isReset = false;
var foco_fim = false;
var descanso_fim = false;
var id_pomo = currentId;

console.log('oi')

//pega o id na url
function getIdFromUrl() {
    var path = window.location.pathname;
    var id = path.substring(path.lastIndexOf('/') + 1);
    return parseInt(id, 10);
}

var currentId = getIdFromUrl();

// Filtrar o array para obter o item com o ID correspondente
var filteredData = pomoData.filter(function(item) {
    return item.id === currentId;
});

// Se houver dados correspondentes, faça algo com eles
if (filteredData.length > 0) {
    var item = filteredData[0];

    temp_completo = item.temp_completo;
    foco = item.foco;
    descanso = item.descanso;
} else {
    console.log("Nenhum item encontrado com o ID fornecido.");
}


let timerDivs = [];

function start() {
    min = getTimeValue(temp_completo);
    minFoco = getTimeValue(foco);

    interval_completo = setInterval(watch_completo, 1000);
    interval_foco = setInterval(watch_foco, 10);
    isStarted = true;
    isStopped = false;
    isReset = false;
    saveMysql();

    var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement) {
        console.error('Elemento CSRF não encontrado');
        return;
    }

    var csrfToken = csrfTokenElement.getAttribute('content');
    var id_pomo = currentId;
    var tempCompleto_min = min < 10 ? '0' + min:min
    var tempCompleto_sec = sec < 10 ? '0' + sec:sec
    
    fetch('/start_check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id_pomo: id_pomo })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data);
        if (typeof data === 'object') {
            const timer = data.data;
            if (parseInt(timer.start, 10) === 1) {
                let timerDiv = document.createElement('div');
                timerDiv.className = 'row mb-3';

                timerDiv.innerHTML = `
                    <div class="history-item">
                    <i class="fas fa-play"></i>
                    <div>
                        <strong>Start</strong>
                        <span>Tempo completo: <b>${tempCompleto_min}:${tempCompleto_sec}</b></span>
                    </div>
                </div>
                `;

                timerDivs.push(timerDiv);

                updateTimerContainer();
            }
        } else {
            console.error('Resposta do servidor não é um objeto.');
        }
    })
    .catch((error) => {
        console.error('Erro:', error);
    });
}

function stop() {
    clearInterval(interval_completo);
    clearInterval(interval_foco);
    clearInterval(interval_descanso);
    foco_fim = false;
    descanso_fim = false;
    isStarted = false;
    isStopped = true;
    isReset = false;

    var tempCompleto_min = min < 10 ? '0' + min:min
    var tempCompleto_sec = sec < 10 ? '0' + sec:sec
    var focoMin = minFoco < 10 ? '0' + minFoco:minFoco
    var focoSec = secFoco < 10 ? '0' + secFoco:secFoco
    var descansoMin = minDescanso < 10 ? '0' + minDescanso:minDescanso
    var descansoSec = secDescanso < 10 ? '0' + secDescanso:secDescanso
    
    console.log(focoMin)


    saveMysql();

    var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement) {
        console.error('Elemento CSRF não encontrado');
        return;
    }

    var csrfToken = csrfTokenElement.getAttribute('content');
    var id_pomo = currentId;

    fetch('/stop_check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id_pomo: id_pomo })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data);
        if (typeof data === 'object') {
            const timer = data.data;
            if (parseInt(timer.stop, 10) === 1) {
                let timerDiv = document.createElement('div');
                timerDiv.className = 'row mb-3';

                timerDiv.innerHTML = `
                    <div class="history-item">
                    <i class="fas fa-stop"></i>
                    <div>
                        <strong>Stop</strong>
                        <span>Tempo completo: <b>${tempCompleto_min}:${tempCompleto_sec}</b> Tempo de foco: <b>${focoMin}:${focoSec}</b> Tempo de descanso: <b>${descansoMin}:${descansoSec}</b></span>
                    </div>
                </div>
                `;

                timerDivs.push(timerDiv);

                updateTimerContainer();
            }
        } else {
            console.error('Resposta do servidor não é um objeto.');
        }
    })
    .catch((error) => {
        console.error('Erro:', error);
    });
}

function reset() {
    clearInterval(interval_completo);
    clearInterval(interval_foco);
    clearInterval(interval_descanso);
    sec = 0;
    secFoco = 0;
    secDescanso = 0;
    min = 0;
    minDescanso = 0;
    minFoco = 0;
    document.getElementById("watch-completo").innerHTML = "00:00";
    document.getElementById("watch-foco").innerHTML = "00:00";
    document.getElementById("watch-descanso").innerHTML = "00:00";
    isStarted = false;
    isStopped = false;
    isReset = true;
    saveMysql();

    var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement) {
        console.error('Elemento CSRF não encontrado');
        return;
    }

    var csrfToken = csrfTokenElement.getAttribute('content');
    var id_pomo = currentId;

    fetch('/reset_check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id_pomo: id_pomo })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data);
        if (typeof data === 'object') {
            const timer = data.data;
            if (parseInt(timer.reset, 10) === 1) {
                let timerDiv = document.createElement('div');
                timerDiv.className = 'row mb-3';

                timerDiv.innerHTML = `
                     <div class="history-item">
                    <i class="fas fa-undo-alt"></i>
                    <div>
                        <strong>Reset</strong>
                        <span>O cronômetro foi resetado</span>
                    </div>
                </div>
                `;

                timerDivs.push(timerDiv);

                updateTimerContainer();
            }       
        } else {
            console.error('Resposta do servidor não é um objeto.');
        }
    })
    .catch((error) => {
        console.error('Erro:', error);
    });
}

function getTimeValue(selection) {
    switch (selection) {
        case 1: return 10;
        case 2: return 20;
        case 3: return 30;
        case 4: return 40;
        case 5: return 50;
        default: return 0;
    }
}

function updateTimerContainer() {
    const container = document.getElementById('timerContainer');
    container.innerHTML = ''; 

    timerDivs.forEach(timerDiv => {
        container.appendChild(timerDiv);
    });
}

function watch_completo() {
    if (sec === 0) {
        if (min > 0) {
            min--;
            sec = 59;
        } else {
            clearInterval(interval_completo);
            console.log("Tempo acabou!");
        }
    } else {
        sec--;
    }
    document.getElementById("watch-completo").innerText = (min < 10 ? '0' : '') + min + ':' + (sec < 10 ? '0' : '') + sec;

}

function watch_foco() {
    if (secFoco === 0) {
        if (minFoco > 0) {
            minFoco--;
            secFoco = 59;
        } else {
            clearInterval(interval_foco);
            console.log("Tempo acabou!");
            alert("O tempo de foco acabou!!!!!");
            foco_fim = true;
            descanso_fim = false;
                saveMysql();

            if (descanso == 1) minDescanso = 3;
            else if (descanso == 2) minDescanso = 5;
            else if (descanso == 3) minDescanso = 7;
            else if (descanso == 4) minDescanso = 9;
            else if (descanso == 5) minDescanso = 11;
            interval_descanso = setInterval(watch_descanso, 10); // Ajuste o intervalo para 1 segundo
        }
    } else {
        secFoco--;
    }
    document.getElementById("watch-foco").innerText = (minFoco < 10 ? '0' : '') + minFoco + ':' + (secFoco < 10 ? '0' : '') + secFoco;
}

function watch_descanso(){
    if (secDescanso === 0) {
        if (minDescanso > 0) {
            console.log(minDescanso);
            minDescanso--;
            secDescanso = 59;
        } else {
            clearInterval(interval_descanso); 
            console.log("Descanso acabou!");
            alert("O tempo de descanso acabou!!!!!");
            foco_fim = false;
            descanso_fim = true;
            saveMysql()

            if (foco == 1) minFoco = 10;
            else if (foco == 2) minFoco = 20;
            else if (foco == 3) minFoco = 30;
            else if (foco == 4) minFoco = 40;
            else if (foco == 5) minFoco = 50;

            secFoco = 0;
            interval_foco = setInterval(watch_foco, 10); 
        }
    } else {
        secDescanso--;
    }
    document.getElementById("watch-descanso").innerText = (minDescanso < 10 ? '0' : '') + minDescanso + ':' + (secDescanso < 10 ? '0' : '') + secDescanso;
}
function saveMysql() {
    var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement) {
        console.error('Elemento CSRF não encontrado');
        return;
    }
    var csrfToken = csrfTokenElement.getAttribute('content');

    var minSave = min; 
    var secSave = sec;
    var minSaveFoco = minFoco;
    var secSaveFoco = secFoco;
    var minSaveDescanso = minDescanso;
    var secSaveDescanso = secDescanso;
    var start = isStarted;
    var stop = isStopped;
    var reset = isReset;
    var id_pomo = currentId;

    var data 
    
    if (descanso_fim || foco_fim === true) {
    data = {
        temp_completo_min: minSave,
        temp_completo_sec: secSave,
        foco_min: minSaveFoco,
        foco_sec: secSaveFoco,
        descanso_min: minSaveDescanso,
        descanso_sec: secSaveDescanso,
        start: 0,
        stop: 0,
        reset: 0,
        foco_fim: foco_fim,
        descanso_fim: descanso_fim,
        id_pomo: id_pomo
    };
} else {
    data = {
        temp_completo_min: minSave,
        temp_completo_sec: secSave,
        foco_min: minSaveFoco,
        foco_sec: secSaveFoco,
        descanso_min: minSaveDescanso,
        descanso_sec: secSaveDescanso,
        start: start,
        stop: stop,
        reset: reset,
        foco_fim: foco_fim,
        descanso_fim: descanso_fim,
        id_pomo: id_pomo
    };
}
    console.log('Enviando dados para o servidor:');

    fetch('/save_data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data) // Corrigido aqui
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data);
    })
    .catch((error) => {
        console.error('Erro:', error);
    });
}