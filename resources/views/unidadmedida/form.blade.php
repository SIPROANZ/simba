<div class="box box-info padding-1">
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Nombre de Unidad de Medida') }}
            {{ Form::text('nombre', $unidadmedida->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingresar Nombre de la Unidad de Medida']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>
