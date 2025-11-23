<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentsController extends Controller
{

    public function index()
    {
        $appointments = Appointments::paginate(20);
        return view('system.appointments.index', ['appointments' => $appointments]);
    }

    public function create()
    {
        return view('system.appointments.create');
    }  

    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $appointment = Appointments::create([
                'pet_name'    => $validated['pet_name'],
                'owner_phone' => $validated['owner_phone'],
                'date'        => $validated['date'],
                'time'        => $validated['time'],
                'services'    => json_encode($validated['services']), // salva como JSON
                'total_value' => $validated['total_value'],
            ]);

            DB::commit();
            return redirect()->route('appointments.index')
                             ->with('success', 'Agendamento criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar agendamento: '.$e->getMessage());
            return back()->withInput()->with('error', 'Não foi possível criar o agendamento.');
        }
    }

    public function edit(Appointments $appointment)
    {
        return view('system.appointments.edit', compact('appointment'));
    }

    public function update(AppointmentRequest $request, Appointments $appointment)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $appointment->update([
                'pet_name'    => $validated['pet_name'],
                'owner_phone' => $validated['owner_phone'],
                'date'        => $validated['date'],
                'time'        => $validated['time'],
                'services'    => json_encode($validated['services']),
                'total_value' => $validated['total_value'],
            ]);

            DB::commit();
            return redirect()->route('appointments.index')
                             ->with('success', 'Agendamento atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar agendamento: '.$e->getMessage());
            return back()->withInput()->with('error', 'Não foi possível atualizar o agendamento.');
        }
    }

    public function destroy(Appointments $appointment)
{
    try {
        $appointment->delete();

        Log::info('Agendamento apagado.', ['appointment' => $appointment->id]);

        return redirect()->route('appointments.index')->with('success', 'Agendamento excluído com sucesso!');
    } catch (\Exception $e) {
        Log::error('Agendamento não apagado.', ['error' => $e->getMessage()]);

        return redirect()->route('appointments.index')->with('error', 'Agendamento não foi excluído!');
    }
}
}
