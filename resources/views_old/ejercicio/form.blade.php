<div class="box box-info padding-1">
    <div class="box-body">
       <div class="row">
                <div class="form-group">
                    {{ Form::label('Nombre ejercicio') }}
                    {{ Form::text('nombreejercicio', $ejercicio->nombreejercicio, ['class' => 'form-control' . ($errors->has('nombreejercicio') ? ' is-invalid' : ''), 'placeholder' => 'Nombre ejercicio']) }}
                    {!! $errors->first('nombreejercicio', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Ejercicio Origen') }}
                    {{ Form::text('ejercicioorigen', $ejercicio->ejercicioorigen, ['class' => 'form-control' . ($errors->has('ejercicioorigen') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio origen']) }}
                    {!! $errors->first('ejercicioorigen', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('ejercicio Ejecución') }}
                    {{ Form::text('ejercicioejecucion', $ejercicio->ejercicioejecucion, ['class' => 'form-control' . ($errors->has('ejercicioejecucion') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio ejecución']) }}
                    {!! $errors->first('ejercicioejecucion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Status') }}
                    {{ Form::text('estatus', $ejercicio->estatus, ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
                    {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
                </div>           
                <div class="form-group">
                    {{ Form::label('Observación') }}
                    {{ Form::text('observacion', $ejercicio->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observación']) }}
                    {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            
         </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>