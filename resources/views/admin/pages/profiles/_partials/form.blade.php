@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome do perfil</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $profile->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="description">Descrição do perfil</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição..."
        value="{{ $profile->description ?? old("description") }}">
</div>