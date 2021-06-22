@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome da categoria</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome..."
        value="{{ $category->name ?? old("name") }}">
</div>
<div class="form-group">
    <label for="description">Descrição da categoria</label>
    <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $category->description ?? old("description") }}</textarea>
</div>