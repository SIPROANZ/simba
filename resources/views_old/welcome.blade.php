<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <select name="" id="_unidadadministrativa">
              <option value="">Seleccione una opcion</option>
            @foreach ($unidades as $item)
            <option value="{{$item->id}}">{{$item->denominacion}}</option>
            @endforeach
        </select>

        <select name="" id="_requisicion"></select>
     <!-- Escribi para responder cuando se seleccione una unidad adminsitrativa -->
<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('_unidadadministrativa').addEventListener('change',(e)=>{
        fetch('requisicion',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].concepto+'</option>';
            }
            document.getElementById("_requisicion").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

   /* document.getElementById('_subcategoria').addEventListener('change',(e)=>{
        fetch('empresas',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre+'</option>';
            }
            document.getElementById("_empresa").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
    */

</script>   
</body>
</html>