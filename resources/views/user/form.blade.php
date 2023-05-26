<div class="box box-info padding-1">
    <div class="box-body">
        

    <div class="row">
        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Nombre De Usuario') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('unidad administrativa') }}
            {{ Form::select('unidad_id', $unidades, $user->unidad_id, ['class' => 'form-control' . ($errors->has('unidad_id') ? ' is-invalid' : ''), 'placeholder' => 'seleccione una unidad adminsitrativa']) }}
            {!! $errors->first('unidad_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('password') }}
            {{ Form::password('password', $user->password, ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Clave Secreta']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>