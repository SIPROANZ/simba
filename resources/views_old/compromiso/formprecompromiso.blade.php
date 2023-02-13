<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        
        <div class="form-group">
            
            {{ Form::hidden('tipocompromiso_id', $precompromiso_tipo, ['class' => 'form-control' . ($errors->has('tipocompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('tipocompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto compromiso') }}
            {{ Form::text('montocompromiso', $precompromiso->montototal, ['class' => 'form-control' . ($errors->has('montocompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Monto compromiso']) }}
            {!! $errors->first('montocompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $compromiso->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $compromiso->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
    
        <div class="form-group">
            
            {{ Form::hidden('unidadadministrativa_id', $precompromiso->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

        <div class="form-group">
            {{ Form::hidden('ncompromiso', 0, ['class' => 'form-control' . ($errors->has('ncompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Ncompromiso']) }}
            {!! $errors->first('ncompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>

       
        <div class="form-group">
            {{ Form::hidden('beneficiario_id', $beneficiario, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        
        <div class="form-group">
            {{ Form::hidden('status', 'EP',  ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        
        <div class="form-group">
            
            {{ Form::hidden('fechaanulacion', $compromiso->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha anulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
      
        <div class="form-group">
            {{ Form::hidden('precompromiso_id', $precompromiso->id, ['class' => 'form-control' . ($errors->has('precompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Precompromiso']) }}
            {!! $errors->first('precompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        
        <div class="form-group">
            {{ Form::hidden('compra_id', $compromiso->compra_id, ['class' => 'form-control' . ($errors->has('compra_id') ? ' is-invalid' : ''), 'placeholder' => 'Compra']) }}
            {!! $errors->first('compra_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::hidden('ayuda_id', $compromiso->ayuda_id, ['class' => 'form-control' . ($errors->has('ayuda_id') ? ' is-invalid' : ''), 'placeholder' => 'Ayuda']) }}
            {!! $errors->first('ayuda_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>