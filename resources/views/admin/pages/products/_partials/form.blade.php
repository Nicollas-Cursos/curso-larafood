@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Título do produto</label>
    <input type="text" id="title" name="title" class="form-control" placeholder="Título..."
        value="{{ $product->title ?? old("title") }}">
</div>
<div class="form-group">
    <label for="description">Descrição do produto</label>
    <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $product->description ?? old("description") }}</textarea>
</div>
<div class="form-group">
    <label for="price">Preço do produto</label>
    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="image">Imagem do produto</label>
    <input type="file" name="image" id="image" accept="image/*">
</div>