@foreach ($user->roles as $role)
    <span class="badge bg-label-secondary">{{ $role->title }}</span>
@endforeach