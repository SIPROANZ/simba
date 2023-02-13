<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{-- @if (isset($task) && $task == 'edit') --}}
                    {{ Form::label('Logo') }}
                    {{ Form::file('logoinstitucion', $institucione->logoinstitucion, ['class' => 'form-control' . ($errors->has('logoinstitucion') ? ' is-invalid' : ''), 'placeholder' => 'Logo Institución']) }}
                    {!! $errors->first('logoinstitucion', '<div class="invalid-feedback">:message</div>') !!}
                    {{-- @endif --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('RIF') }}
                    {{ Form::text('rif', $institucione->rif, ['class' => 'form-control' . ($errors->has('rif') ? ' is-invalid' : ''), 'placeholder' => 'RIF']) }}
                    {!! $errors->first('rif', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Institución') }}
                    {{ Form::text('institucion', $institucione->institucion, ['class' => 'form-control' . ($errors->has('institucion') ? ' is-invalid' : ''), 'placeholder' => 'Institución']) }}
                    {!! $errors->first('institucion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Razon Social') }}
                    {{ Form::text('razonsocial', $institucione->razonsocial, ['class' => 'form-control' . ($errors->has('razonsocial') ? ' is-invalid' : ''), 'placeholder' => 'Razon Social']) }}
                    {!! $errors->first('razonsocial', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Municipio') }}
                    {{ Form::select('municipio_id', $municipio, $institucione->municipio_id, ['class' => 'form-control' . ($errors->has('municipio_id') ? ' is-invalid' : ''), 'placeholder' => 'Municipio']) }}
                    {!! $errors->first('municipio_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Dirección') }}
                    {{ Form::text('direccion', $institucione->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Teléfono') }}
                    {{ Form::text('telefono', $institucione->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono']) }}
                    {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Email') }}
                    {{ Form::text('email', $institucione->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Pagina Web') }}
                    {{ Form::text('web', $institucione->web, ['class' => 'form-control' . ($errors->has('web') ? ' is-invalid' : ''), 'placeholder' => 'Pagina Web']) }}
                    {!! $errors->first('web', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Codigo Postal') }}
                    {{ Form::text('codigopostal', $institucione->codigopostal, ['class' => 'form-control' . ($errors->has('codigopostal') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Postal']) }}
                    {!! $errors->first('codigopostal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Base Legal') }}
                    {{ Form::text('baselegal', $institucione->baselegal, ['class' => 'form-control' . ($errors->has('baselegal') ? ' is-invalid' : ''), 'placeholder' => 'Base Legal']) }}
                    {!! $errors->first('baselegal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Visión') }}
                    {{ Form::text('vision', $institucione->vision, ['class' => 'form-control' . ($errors->has('vision') ? ' is-invalid' : ''), 'placeholder' => 'Visión']) }}
                    {!! $errors->first('vision', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Misión') }}
                    {{ Form::text('mision', $institucione->mision, ['class' => 'form-control' . ($errors->has('mision') ? ' is-invalid' : ''), 'placeholder' => 'Misión']) }}
                    {!! $errors->first('mision', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Organigrama') }}
                    {{ Form::file('organigrama', $institucione->organigrama, ['class' => 'form-control' . ($errors->has('organigrama') ? ' is-invalid' : ''), 'placeholder' => 'Organigrama']) }}
                    {!! $errors->first('organigrama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
