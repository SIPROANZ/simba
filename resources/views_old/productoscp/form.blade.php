<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Producto') }}
            {{ Form::select('producto_id', $productos, $productoscp->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el producto']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('clasificadorpresupuestario') }}
            {{ Form::select('clasificadorp_id', $clasificadorpresupuestarios, $productoscp->clasificadorp_id, ['class' => 'form-control' . ($errors->has('clasificadorp_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el clasificador Presupuestario']) }}
            {!! $errors->first('clasificadorp_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>
        

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>