<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $bo->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Producto') }}
            {{ Form::select('producto_id', $productoscp,  $bo->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Producto']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Unidad de Medida') }}
            {{ Form::select('unidadmedida_id', $unidadmedida, $bo->unidadmedida_id, ['class' => 'form-control' . ($errors->has('unidadmedida_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Unidad de Medida']) }}
            {!! $errors->first('unidadmedida_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de BOS') }}
            {{ Form::select('tipobos_id', $tipobo, $bo->tipobos_id, ['class' => 'form-control' . ($errors->has('tipobos_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Tipo de BOS']) }}
            {!! $errors->first('tipobos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
