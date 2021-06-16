@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome do usuário</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $user->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="email">E-mail do usuário</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail..."
        value="{{ $user->email ?? old("email") }}">
</div>
<div class="form-group">
    <label for="password">Senha do usuário</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Senha...">
</div>