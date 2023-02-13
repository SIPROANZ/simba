<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
    <div class="col-md-3">  
        <div class="form-group">
            {{ Form::label('Codigo producto') }}
            {{ Form::text('codigoproducto', $producto->codigoproducto, ['class' => 'form-control' . ($errors->has('codigoproducto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('codigoproducto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Clase') }}
            {{ Form::select('clase_id', $clases, $producto->clase_id, ['class' => 'form-control' . ($errors->has('clase_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la clase']) }}
            {!! $errors->first('clase_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>
            </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>