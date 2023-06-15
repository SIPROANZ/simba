<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('cedula') }}
            {{ Form::text('cedula', $asistencia->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Cedula']) }}
            {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('evento') }}
            {{ Form::select('evento_id', $eventos, $asistencia->evento_id, ['class' => 'form-control' . ($errors->has('evento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('evento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>