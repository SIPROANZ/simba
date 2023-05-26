<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto base') }}
            {{ Form::text('montobase', $total_base, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => 'Monto base']) }}
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('analisis_id', $analisis_id, ['class' => 'form-control' . ($errors->has('analisis_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un analisis']) }}
            {{ Form::hidden('numordencompra', 0, ['class' => 'form-control' . ($errors->has('numordencompra') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden de compra']) }}
            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {{ Form::hidden('fechaanulacion', '', ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de anulacion']) }}
           
        </div>
        </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto iva') }}
            {{ Form::text('montoiva', $total_iva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => 'Monto iva']) }}
            {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto total') }}
            {{ Form::text('montototal', $total, ['class' => 'form-control' . ($errors->has('montototal') ? ' is-invalid' : ''), 'placeholder' => 'Monto total']) }}
            {!! $errors->first('montototal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $compra->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>

    </div>
    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>