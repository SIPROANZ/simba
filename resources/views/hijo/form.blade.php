<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $hijo->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cedula') }}
            {{ Form::text('cedula', $hijo->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Cedula']) }}
            {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('genero') }}
            {{ Form::text('genero', $hijo->genero, ['class' => 'form-control' . ($errors->has('genero') ? ' is-invalid' : ''), 'placeholder' => 'Genero']) }}
            {!! $errors->first('genero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('anexocedula') }}
            {{ Form::text('anexocedula', $hijo->anexocedula, ['class' => 'form-control' . ($errors->has('anexocedula') ? ' is-invalid' : ''), 'placeholder' => 'Anexocedula']) }}
            {!! $errors->first('anexocedula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('anexopartida') }}
            {{ Form::text('anexopartida', $hijo->anexopartida, ['class' => 'form-control' . ($errors->has('anexopartida') ? ' is-invalid' : ''), 'placeholder' => 'Anexopartida']) }}
            {!! $errors->first('anexopartida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cedularepresentante') }}
            {{ Form::text('cedularepresentante', $hijo->cedularepresentante, ['class' => 'form-control' . ($errors->has('cedularepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Cedularepresentante']) }}
            {!! $errors->first('cedularepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('observacion') }}
            {{ Form::text('observacion', $hijo->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observacion']) }}
            {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>