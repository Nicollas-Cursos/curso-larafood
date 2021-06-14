@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome do Detalhe</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $detail->name ?? old("name") }}">
</div>