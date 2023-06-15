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
            {{ Form::label('Fecha de Nacimiento') }}
            {{ Form::date('created_at', $hijo->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de nacimiento']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('genero') }}
            {{ Form::select('genero', ['MASCULINO'=>'MASCULINO', 'FEMENINO'=>'FEMENINO'], $hijo->genero, ['class' => 'form-control' . ($errors->has('genero') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('genero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
        <div class="form-group">
            {{ Form::label('cedula del representante') }}
            {{ Form::text('cedularepresentante', $hijo->cedularepresentante, ['class' => 'form-control' . ($errors->has('cedularepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Cedularepresentante']) }}
            {!! $errors->first('cedularepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('observacion') }}
            {{ Form::text('observacion', $hijo->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observacion']) }}
            {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- Imagen para la foto de perfil y para la imagen de la cedula --}}
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('imagen de perfil') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Imagen de la Cédula') }}
            {{ Form::file('anexocedula', ['class' => 'form-control' . ($errors->has('anexocedula') ? ' is-invalid' : ''), 'placeholder' => 'Imagen Cedula']) }}
            {!! $errors->first('anexocedula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Imagen de Partida Nacimiento') }}
            {{ Form::file('anexopartida', ['class' => 'form-control' . ($errors->has('anexopartida') ? ' is-invalid' : ''), 'placeholder' => 'Imagen Partida']) }}
            {!! $errors->first('anexopartida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>