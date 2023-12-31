<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo de Retención') }}
            {{ Form::hidden('retencion_id', $detalleretencione->retencion_id, ['class' => 'form-control' . ($errors->has('retencion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese un Tipo']) }}
            {!! $errors->first('retencion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::hidden('ordenpago_id', $detalleretencione->ordenpago_id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::hidden('montoneto', $detalleretencione->montoneto, ['class' => 'form-control' . ($errors->has('montoneto') ? ' is-invalid' : ''), 'placeholder' => 'Montoneto']) }}
            {!! $errors->first('montoneto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::text('montoIVA', $detalleretencione->montoIVA, ['class' => 'form-control' . ($errors->has('montoIVA') ? ' is-invalid' : ''), 'placeholder' => 'Montoiva']) }}
            {!! $errors->first('montoIVA', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>