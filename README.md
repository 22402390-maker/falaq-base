# FalaQ - Projeto Laravel base para a 3ª Etapa

Rode os comandos a baixo no terminal na sua pasta de documentos para clonar e configurar o repositório
```sh
#git clone https://github.com/nato-re/falaq-base.git
#cd falaq-base
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```

## Sprint 02 — Guia de Execução

### O que foi feito

**Ticket #003 — Relacionamento N:1 (Pergunta ↔ User)**
- `app/Models/Pergunta.php`: adicionado `user()` (`belongsTo(User::class)`) e `user_id` ao `$fillable`.
- `app/Models/User.php`: adicionado `perguntas()` (`hasMany(Pergunta::class)`).
- `resources/views/eventos/show.blade.php`: cada card de pergunta agora exibe `{{ $pergunta->user->name ?? 'Anônimo' }}`.

**Ticket #004 — Eager Loading (N+1)**
- `app/Http/Controllers/EventoController.php`, método `show()`: a query passou a usar `with('user')` antes da paginação, além de manter o filtro por `evento_id`, ordenação por `created_at` decrescente e `paginate(10)`.

### Como rodar

```sh
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

### Como validar

1. Acesse a página de um evento (`/eventos/{id}`).
2. Confira se o nome do autor aparece em cada card de pergunta (ou "Anônimo" quando não houver usuário vinculado).
3. Confira a paginação de 10 em 10 e a ordenação decrescente pelas mais recentes.
4. Para checar o fim do N+1, habilite o log de queries (por exemplo, com `DB::listen` no `AppServiceProvider` ou com o Laravel Debugbar) e acesse `/eventos/{id}`: deve haver apenas uma query para buscar as perguntas e uma para os usuários relacionados (via `with('user')`), em vez de uma query por pergunta.
