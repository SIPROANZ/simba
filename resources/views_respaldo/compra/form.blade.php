<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('analisis') }}
            {{ Form::text('analisis_id', $compra->analisis_id, ['class' => 'form-control' . ($errors->has('analisis_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un analisis']) }}
            {!! $errors->first('analisis_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('numero orden de compra') }}
            {{ Form::text('numordencompra', $compra->numordencompra, ['class' => 'form-control' . ($errors->has('numordencompra') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden de compra']) }}
            {!! $errors->first('numordencompra', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::select('status', ['EP'=>'EN PROCESO', 'PR'=>'PROCESADO', 'AN'=>'ANULADO'],$compra->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Anulacion') }}
            {{ Form::date('fechaanulacion', $compra->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de anulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto base') }}
            {{ Form::text('montobase', $compra->montobase, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => 'Monto base']) }}
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto iva') }}
            {{ Form::text('montoiva', $compra->montoiva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => 'Monto iva']) }}
            {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto total') }}
            {{ Form::text('montototal', $compra->montototal, ['class' => 'form-control' . ($errors->has('montototal') ? ' is-invalid' : ''), 'placeholder' => 'Monto total']) }}
            {!! $errors->first('montototal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>