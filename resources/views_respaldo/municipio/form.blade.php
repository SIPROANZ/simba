<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
        
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $municipio->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('codigo') }}
            {{ Form::text('codigo', $municipio->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::select('estado_id', $estados, $municipio->estado_id, ['class' => 'form-control' . ($errors->has('estado_id') ? ' is-inv              alid' : ''), 'placeholder' => 'Seleccione un estado']) }}
            {!! $errors->first('estado_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>
    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>