@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome do plano</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $plan->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="price">Preço do plano</label>
    <input type="text" id="price" name="price" class="form-control" placeholder="Preço..."
        value="{{ $plan->price ?? old("price") }}">
</div>
<div class="form-group">
    <label for="description">Descrição do plano</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição..."
        value="{{ $plan->description ?? old("description") }}">
</div>