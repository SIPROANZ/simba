<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
        <div class="form-group">
            {{ Form::hidden('ordenpago_id', session('ordenpago'), ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('numero_factura') }}
            {{ Form::text('numero_factura', $factura->numero_factura, ['class' => 'form-control' . ($errors->has('numero_factura') ? ' is-invalid' : ''), 'placeholder' => 'Numero Factura']) }}
            {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('numero_control') }}
            {{ Form::text('numero_control', $factura->numero_control, ['class' => 'form-control' . ($errors->has('numero_control') ? ' is-invalid' : ''), 'placeholder' => 'Numero Control']) }}
            {!! $errors->first('numero_control', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $factura->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('montobase') }}
            {{ Form::text('montobase', $factura->montobase, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => 'Montobase']) }}
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('montoiva') }}
            {{ Form::text('montoiva', $factura->montoiva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => 'Montoiva']) }}
            {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('montototal') }}
            {{ Form::text('montototal', $factura->montototal, ['class' => 'form-control' . ($errors->has('montototal') ? ' is-invalid' : ''), 'placeholder' => 'Montototal']) }}
            {!! $errors->first('montototal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>