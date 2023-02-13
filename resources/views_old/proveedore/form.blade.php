<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

    <h3>Ingrese Datos del Proveedor</h3>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Proveedor') }}
            {{ Form::select('caracterbeneficiario',['V'=>'V', 'J'=>'J', 'E'=>'E', 'P'=>'P', 'G'=>'G'], $proveedore->caracterbeneficiario, ['class' => 'form-control' . ($errors->has('caracterbeneficiario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Caracter del proveedor']) }}
            {!! $errors->first('caracterbeneficiario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $proveedore->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('rif') }}
            {{ Form::text('rif', $proveedore->rif, ['class' => 'form-control' . ($errors->has('rif') ? ' is-invalid' : ''), 'placeholder' => 'Rif']) }}
            {!! $errors->first('rif', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>


        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de residencia') }}
            {{ Form::select('tiporesidencia',['Domiciliada Residente'=>'Domiciliada Residente', 'No Domiciliada No Residente'=>'No Domiciliada No Residente'], $proveedore->tiporesidencia, ['class' => 'form-control' . ($errors->has('tiporesidencia') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el tipo de residencia']) }}
            {!! $errors->first('tiporesidencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de proveedor') }}
            {{ Form::select('tipobeneficiario',['Proveedor'=>'Proveedor', 'Contratista'=>'Contratista', 'Cooperativa'=>'Cooperativa', 'Fundacion'=>'Fundacion', 'Otros'=>'Otros'], $proveedore->tipobeneficiario, ['class' => 'form-control' . ($errors->has('tipobeneficiario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el tipo de proveedor']) }}
            {!! $errors->first('tipobeneficiario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de contribuyente') }}
            {{ Form::select('tipocontribuyente',['Ordinario'=>'Ordinario', 'Formales'=>'Formales', 'Ocasionales'=>'Ocasionales'], $proveedore->tipocontribuyente, ['class' => 'form-control' . ($errors->has('tipocontribuyente') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el tipo de contribuyente']) }}
            {!! $errors->first('tipocontribuyente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $proveedore->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $proveedore->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
            </div>
            </div>

            <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $proveedore->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('correo') }}
            {{ Form::text('correo', $proveedore->correo, ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco') }}
            {{ Form::text('banco', $proveedore->banco, ['class' => 'form-control' . ($errors->has('banco') ? ' is-invalid' : ''), 'placeholder' => 'Banco']) }}
            {!! $errors->first('banco', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('numero de cuenta') }}
            {{ Form::text('numerocuenta', $proveedore->numerocuenta, ['class' => 'form-control' . ($errors->has('numerocuenta') ? ' is-invalid' : ''), 'placeholder' => 'Numero de cuenta']) }}
            {!! $errors->first('numerocuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
        
    <h3><br>Ingrese Datos del Representante Legal</h3>
    <div class="col-md-4">
        <div class="form-group">
            
            {{ Form::label('documento del representante legal') }}
            {{ Form::text('documentorepresentante', $proveedore->documentorepresentante, ['class' => 'form-control' . ($errors->has('documentorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Documento del representante']) }}
            {!! $errors->first('documentorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre del representante') }}
            {{ Form::text('nombrerepresentante', $proveedore->nombrerepresentante, ['class' => 'form-control' . ($errors->has('nombrerepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del representante']) }}
            {!! $errors->first('nombrerepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('telefono del representante') }}
            {{ Form::text('telefonorepresentante', $proveedore->telefonorepresentante, ['class' => 'form-control' . ($errors->has('telefonorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Telefono del representante']) }}
            {!! $errors->first('telefonorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>


        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('correo del representante') }}
            {{ Form::text('correorepresentante', $proveedore->correorepresentante, ['class' => 'form-control' . ($errors->has('correorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Correo del representante']) }}
            {!! $errors->first('correorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('banco del representante') }}
            {{ Form::text('bancorepresentante', $proveedore->bancorepresentante, ['class' => 'form-control' . ($errors->has('bancorepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Banco del representante']) }}
            {!! $errors->first('bancorepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('numero de cuenta del representante') }}
            {{ Form::text('numerocuentarepresentante', $proveedore->numerocuentarepresentante, ['class' => 'form-control' . ($errors->has('numerocuentarepresentante') ? ' is-invalid' : ''), 'placeholder' => 'Numero de cuenta del representante']) }}
            {!! $errors->first('numerocuentarepresentante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>