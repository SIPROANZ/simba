<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Plan operativo anual') }}
            {{ Form::select('poa_id', $poas, $meta->poa_id, ['class' => 'form-control' . ($errors->has('poa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione plan operativo anual']) }}
            {!! $errors->first('poa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Cant.1') }}
            {{ Form::text('cantidad1', $meta->cantidad1, ['class' => 'form-control' . ($errors->has('cantidad1') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('cantidad1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Cant.2') }}
            {{ Form::text('cantidad2', $meta->cantidad2, ['class' => 'form-control' . ($errors->has('cantidad2') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('cantidad2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Cant.3') }}
            {{ Form::text('cantidad3', $meta->cantidad3, ['class' => 'form-control' . ($errors->has('cantidad3') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('cantidad3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Cant.4') }}
            {{ Form::text('cantidad4', $meta->cantidad4, ['class' => 'form-control' . ($errors->has('cantidad4') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('cantidad4', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Meta') }}
            {{ Form::text('meta', $meta->meta, ['class' => 'form-control' . ($errors->has('meta') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('meta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto') }}
            {{ Form::text('monto', $meta->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $meta->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el ejercicio']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucion_id', $instituciones, $meta->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la institucion']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Unidad administrativa') }}
            {{ Form::select('unidadadministrativa_id', $unidadadministrativas, $meta->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la unidad administrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Tipo') }}
            {{ Form::text('tipo', $meta->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Enero') }}
            {{ Form::text('enero', $meta->enero, ['class' => 'form-control' . ($errors->has('enero') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('enero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Febrero') }}
            {{ Form::text('febrero', $meta->febrero, ['class' => 'form-control' . ($errors->has('febrero') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('febrero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Marzo') }}
            {{ Form::text('marzo', $meta->marzo, ['class' => 'form-control' . ($errors->has('marzo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('marzo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Abril') }}
            {{ Form::text('abril', $meta->abril, ['class' => 'form-control' . ($errors->has('abril') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('abril', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Mayo') }}
            {{ Form::text('mayo', $meta->mayo, ['class' => 'form-control' . ($errors->has('mayo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('mayo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Junio') }}
            {{ Form::text('junio', $meta->junio, ['class' => 'form-control' . ($errors->has('junio') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('junio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Julio') }}
            {{ Form::text('julio', $meta->julio, ['class' => 'form-control' . ($errors->has('julio') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('julio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Agosto') }}
            {{ Form::text('agosto', $meta->agosto, ['class' => 'form-control' . ($errors->has('agosto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('agosto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Septiembre') }}
            {{ Form::text('septiembre', $meta->septiembre, ['class' => 'form-control' . ($errors->has('septiembre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('septiembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Octubre') }}
            {{ Form::text('octubre', $meta->octubre, ['class' => 'form-control' . ($errors->has('octubre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('octubre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Noviembre') }}
            {{ Form::text('noviembre', $meta->noviembre, ['class' => 'form-control' . ($errors->has('noviembre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('noviembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Diciembre') }}
            {{ Form::text('diciembre', $meta->diciembre, ['class' => 'form-control' . ($errors->has('diciembre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('diciembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Unidad medida') }}
            {{ Form::text('unidadmedida', $meta->unidadmedida, ['class' => 'form-control' . ($errors->has('unidadmedida') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('unidadmedida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Unidad administrativa solicitante') }}
            {{ Form::text('unidadadministrativasolicitante', $meta->unidadadministrativasolicitante, ['class' => 'form-control' . ($errors->has('unidadadministrativasolicitante') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('unidadadministrativasolicitante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Impacto') }}
            {{ Form::text('impacto', $meta->impacto, ['class' => 'form-control' . ($errors->has('impacto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('impacto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>