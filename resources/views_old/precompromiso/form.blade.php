<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $precompromiso->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('montototal') }}
            {{ Form::text('montototal', $precompromiso->montototal, ['class' => 'form-control' . ($errors->has('montototal') ? ' is-invalid' : ''), 'placeholder' => 'Montototal']) }}
            {!! $errors->first('montototal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('concepto') }}
            {{ Form::text('concepto', $precompromiso->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::hidden('status', $precompromiso->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            
        </div>
        </div>

        <div class="form-group">
           
            {{ Form::hidden('fechaanulacion', $precompromiso->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('unidad administrativa') }}
            {{ Form::select('unidadadministrativa_id', $unidades, $precompromiso->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecccione una unidad adminsitrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo compromiso') }}
            {{ Form::select('tipocompromiso_id', $tipocompromisos, $precompromiso->tipocompromiso_id, ['class' => 'form-control' . ($errors->has('tipocompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de compromiso']) }}
            {!! $errors->first('tipocompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('beneficiario') }}
            {{ Form::select('beneficiario_id',$beneficiarios, $precompromiso->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Beneficiario']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $precompromiso->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
           
       
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>