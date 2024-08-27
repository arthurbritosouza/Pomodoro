<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pomodoro;
use App\Models\Timer;
use Illuminate\Support\Facades\Auth;

class PomodoroController extends Controller
{
    public function cadastrar_user(Request $request)
    {
        $user = new User;
        $user->email = $request->get('email');
        $user->save();

        return redirect()->route('login');
    }

    public function login_user(Request $request)
    {
        $email = $request->get('email');

        if ($email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('index');
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Usuário não encontrado.']);
            }
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Email não fornecido.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function timer_form(Request $request)
    {
        $p = new Pomodoro;
        $p->user_id = Auth::user()->id;
        $p->nome = $request->get('name');
        $p->temp_completo = $request->get('tempo_completo');
        $p->descanso = $request->get('descanso');
        $p->foco = $request->get('tempo_foco');
        $p->save();

        return redirect()->route('index');
    }

    public function saveMysql(Request $request)
    {
        $data = $request->only([
            'temp_completo_min',
            'temp_completo_sec',
            'foco_min',
            'foco_sec',
            'descanso_min',
            'descanso_sec',
            'start',
            'stop',
            'reset',
            'descanso_fim',
            'foco_fim',
            'id_pomo',
        ]);

        $dados = new Timer();
        $dados->user_id = Auth::user()->id;
        $dados->temp_completo_min = $data['temp_completo_min'];
        $dados->temp_completo_sec = $data['temp_completo_sec'];
        $dados->foco_min = $data['foco_min'];
        $dados->foco_sec = $data['foco_sec'];
        $dados->descanso_min = $data['descanso_min'];
        $dados->descanso_sec = $data['descanso_sec'];
        $dados->start = $data['start'];
        $dados->stop = $data['stop'];
        $dados->reset = $data['reset'];
        $dados->foco_fim = $data['foco_fim'];
        $dados->descanso_fim = $data['descanso_fim'];
        $dados->id_pomo = $data['id_pomo'];
        $dados->save();

        return response()->json(['success' => 'Dados salvos com sucesso!']);
    }

    public function checkStart(Request $request)
    {
        try {
            $data = $request->only(['id_pomo']);
            $date = Timer::where('id_pomo', $data['id_pomo'])->orderBy('created_at', 'desc')->first();

            if (!$date) {
                return response()->json(['error' => 'Timer não encontrado'], 400);
            }

            $t = [
                'temp_completo_min' => (int) $date->temp_completo_min,
                'start' => (int) $date->start,
                'id_pomo' => (int) $date->id_pomo,
                'id' => (int) $date->id,
            ];

            return response()->json(['data' => $t]);
        } catch (\Exception $e) {
            \Log::error('Erro no método checkStart: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function checkStop(Request $request)
    {
        try {
            $data = $request->only('id_pomo');
            $timer = Timer::where('id_pomo', $data['id_pomo'])->orderBy('created_at', 'desc')->first();

            if (!$timer) {
                return response()->json(['error' => 'Timer não encontrado'], 404);
            }

            $responseData = [
                'temp_completo_min' => (int) $timer->temp_completo_min,
                'temp_completo_sec' => (int) $timer->temp_completo_sec,
                'foco_min' => (int) $timer->foco_min,
                'foco_sec' => (int) $timer->foco_sec,
                'descanso_min' => (int) $timer->descanso_min,
                'descanso_sec' => (int) $timer->descanso_sec,
                'start' => (int) $timer->start,
                'stop' => (int) $timer->stop,
                'reset' => (int) $timer->reset,
                'descanso_fim' => (int) $timer->descanso_fim,
                'foco_fim' => (int) $timer->foco_fim,
                'id_pomo' => (int) $timer->id_pomo,
                'id' => (int) $timer->id,
            ];

            return response()->json(['data' => $responseData]);
        } catch (\Exception $e) {
            \Log::error('Erro no método checkStop: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function checkReset(Request $request)
    {
        try {
            $data = $request->only('id_pomo');
            $timer = Timer::where('id_pomo', $data['id_pomo'])->orderBy('created_at', 'desc')->first();

            if (!$timer) {
                return response()->json(['error' => 'Timer não encontrado'], 404);
            }

            $responseData = [
                'temp_completo_min' => (int) $timer->temp_completo_min,
                'temp_completo_sec' => (int) $timer->temp_completo_sec,
                'foco_min' => (int) $timer->foco_min,
                'foco_sec' => (int) $timer->foco_sec,
                'descanso_min' => (int) $timer->descanso_min,
                'descanso_sec' => (int) $timer->descanso_sec,
                'start' => (int) $timer->start,
                'stop' => (int) $timer->stop,
                'reset' => (int) $timer->reset,
                'descanso_fim' => (int) $timer->descanso_fim,
                'foco_fim' => (int) $timer->foco_fim,
                'id_pomo' => (int) $timer->id_pomo,
                'id' => (int) $timer->id,
            ];

            return response()->json(['data' => $responseData]);
        } catch (\Exception $e) {
            \Log::error('Erro no método checkReset: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function apagar_time($id)
    {
        Timer::where('id_pomo', $id)->delete();
        return redirect()->back();
    }

    public function apagar_pomo($id)
    {
        Pomodoro::where('id', $id)->delete();
        Timer::where('id_pomo', $id)->delete();
        return redirect()->back();
    }
}
