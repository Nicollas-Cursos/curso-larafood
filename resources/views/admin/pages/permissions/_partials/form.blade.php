@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome da permissão</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $permission->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="description">Descrição da permissão</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição..."
        value="{{ $permission->description ?? old("description") }}">
</div>