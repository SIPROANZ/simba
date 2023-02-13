<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('Codigo') }}
            {{ Form::text('objetivopei', $objetivopei->objetivopei, ['class' => 'form-control' . ($errors->has('objetivopei') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Codigo']) }}
            {!! $errors->first('objetivopei', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-10">
        <div class="form-group">
            {{ Form::label('Objetivo PEI') }}
            {{ Form::text('objetivo', $objetivopei->objetivo, ['class' => 'form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Objetivo PEI']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>


        <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Objetivo Municipal') }}
            {{ Form::select('municipal_id', $objetivomunicipale, $objetivopei->municipal_id, ['class' => 'form-control' . ($errors->has('municipal_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Objetivo Municipal']) }}
            {!! $errors->first('municipal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
