<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Numero Orden de pago: ' . $ordenpagos->nordenpago) }}
            {{ Form::hidden('ordenpago_id', $ordenpagos->id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::text('beneficiario_name', $ordenpagos->beneficiario->nombre,['class' => 'form-control' . ($errors->has('beneficiario_name') ? ' is-invalid' : ''),'readonly', 'placeholder' => 'Beneficiario']) }}
            {!! $errors->first('beneficiario_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto orden de pago') }}
            {{ Form::text('montoordenpago', $ordenpagos->montoneto, ['class' => 'form-control' . ($errors->has('montoordenpago') ? ' is-invalid' : ''),'readonly', 'placeholder' => 'monto orden de pago']) }}
            {!! $errors->first('montoordenpago', '<div class="invalid-feedback">:message</div>') !!}

            
        </div>
        </div>

        
        <div class="form-group">
         
            {{ Form::hidden('montopagado', $pagado->montopagado, ['class' => 'form-control' . ($errors->has('montopagado') ? ' is-invalid' : ''), 'readonly', 'placeholder' => 'Monto pagado']) }}
            {!! $errors->first('montopagado', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('correlativo', $pagado->correlativo, ['class' => 'form-control' . ($errors->has('correlativo') ? ' is-invalid' : ''), 'placeholder' => 'Correlativo']) }}
            {!! $errors->first('correlativo', '<div class="invalid-feedback">:message</div>') !!}
       
        </div>
        

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('Fecha') }}
                {{ Form::date('created_at', $pagado->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
               
           
            </div>
            </div>

            
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo orden pago') }}
            {{ Form::select('tipoordenpago', [ '1' => 'Con Imputacion', '2'=> 'Sin Imputacion' ],$pagado->tipoordenpago, ['class' => 'form-control' . ($errors->has('tipoordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Tipo orden depago']) }}
            {!! $errors->first('tipoordenpago', '<div class="invalid-feedback">:message</div>') !!}
           
          
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de pago') }}
            {{ Form::select('tipomovimiento_id', $tipomovimientos, $pagado->tipomovimiento, ['class' => 'form-control' . ($errors->has('tipomovimiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione tipo de pago']) }}
            {!! $errors->first('tipomovimiento_id', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
      
        </div>
        </div>

        <div class="form-group">
            {{ Form::hidden('beneficiario_id', $ordenpagos->beneficiario->id, ['class' => 'form-control', 'readonly' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::hidden('fechaanulacion', $pagado->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de anulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

       

       
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Enviar</button>
    </div>
</div>