@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome do cargo</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $role->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="description">Descrição do cargo</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição..."
        value="{{ $role->description ?? old("description") }}">
</div>