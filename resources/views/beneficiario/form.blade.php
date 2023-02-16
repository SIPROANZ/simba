<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

   
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Persona') }}
            {{ Form::select('caracterbeneficiario',['V'=>'V', 'J'=>'J', 'E'=>'E', 'P'=>'P', 'G'=>'G', 'C'=>'C'], $beneficiario->caracterbeneficiario, ['class' => 'form-control' . ($errors->has('caracterbeneficiario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccion caracter']) }}
            {!! $errors->first('caracterbeneficiario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Documento') }}
            {{ Form::text('documento', $beneficiario->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Cedula del Beneficiario']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Rif') }}
            {{ Form::text('rif', $beneficiario->rif, ['class' => 'form-control' . ($errors->has('rif') ? ' is-invalid' : ''), 'placeholder' => 'Rif del Beneficiario']) }}
            {!! $errors->first('rif', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>



        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de residencia') }}
            {{ Form::select('tiporesidencia',['Domiciliada Residente'=>'Domiciliada Residente', 'No Domiciliada No Residente'=>'No Domiciliada No Residente'], $beneficiario->tiporesidencia, ['class' => 'form-control' . ($errors->has('tiporesidencia') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de residencia']) }}
            {!! $errors->first('tiporesidencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de beneficiario') }}
            {{ Form::select('tipobeneficiario',['Proveedor'=>'Proveedor', 'Contratista'=>'Contratista', 'Cooperativa'=>'Cooperativa', 'Fundacion'=>'Fundacion', 'Comuna'=>'Comuna', 'Otros'=>'Otros'], $beneficiario->tipobeneficiario, ['class' => 'form-control' . ($errors->has('tipobeneficiario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de beneficiario']) }}
            {!! $errors->first('tipobeneficiario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de contribuyente') }}
            {{ Form::select('tipocontribuyente',['Ordinario'=>'Ordinario', 'Formales'=>'Formales', 'Ocasionales'=>'Ocasionales'], $beneficiario->tipocontribuyente, ['class' => 'form-control' . ($errors->has('tipocontribuyente') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de contribuyente']) }}
            {!! $errors->first('tipocontribuyente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $beneficiario->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Nombre del Beneficiario']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $beneficiario->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la Direccion del Beneficiario']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $beneficiario->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('correo') }}
            {{ Form::text('correo', $beneficiario->correo, ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Correo']) }}
            {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco') }}
            {{ Form::text('banco', $beneficiario->banco, ['class' => 'form-control' . ($errors->has('banco') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el nombre del Banco']) }}
            {!! $errors->first('banco', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('numero de cuenta') }}
            {{ Form::text('numerocuenta', $beneficiario->numerocuenta, ['class' => 'form-control' . ($errors->has('numerocuenta') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Numero de cuenta']) }}
            {!! $errors->first('numerocuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>


        <div class="row">
       
    <div class="col-md-4">
        <div class="form-group">
        
            {{ Form::label('cedula del representante') }}
            {{ Form::text('documentorepresentante', $beneficiario->documentorepresentante, ['class' => 'form-control' . ($errors->has('documentorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la Cedula del representante']) }}
            {!! $errors->first('documentorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre del representante') }}
            {{ Form::text('nombrerepresentante', $beneficiario->nombrerepresentante, ['class' => 'form-control' . ($errors->has('nombrerepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Nombre del representante']) }}
            {!! $errors->first('nombrerepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('telefono del representante') }}
            {{ Form::text('telefonorepresentante', $beneficiario->telefonorepresentante, ['class' => 'form-control' . ($errors->has('telefonorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Telefono del representante']) }}
            {!! $errors->first('telefonorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>


        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('correo del representante') }}
            {{ Form::text('correorepresentante', $beneficiario->correorepresentante, ['class' => 'form-control' . ($errors->has('correorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Correo del representante']) }}
            {!! $errors->first('correorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('banco del representante') }}
            {{ Form::text('bancorepresentante', $beneficiario->bancorepresentante, ['class' => 'form-control' . ($errors->has('bancorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Banco del representante']) }}
            {!! $errors->first('bancorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('numero de cuenta del representante') }}
            {{ Form::text('numerocuentarepresentante', $beneficiario->numerocuentarepresentante, ['class' => 'form-control' . ($errors->has('numerocuentarepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Numero de cuenta del representante']) }}
            {!! $errors->first('numerocuentarepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>