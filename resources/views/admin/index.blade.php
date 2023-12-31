<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div>
                            <div class="bzy">
                                <h1 class="avy awg awp axv">Users</h1>
                                <p class="lb awa axt">A list of all the users in your account including their name,
                                    title, email and role.</p>
                            </div>
                        </div>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{ $user->name }}</td>

                                    <td>
                                        @if ($user->getRoleNames()->isEmpty())
                                            Dont have
                                        @else
                                            @foreach ($user->getRoleNames() as $role)
                                                {{ $role }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ route('admin.show', ['user' => $user->id]) }}"
                                            class="btn btn-primary">Show</a>
                                        <a href="{{ route('admin.edit', ['user' => $user->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        <!-- Formulário de exclusão -->
                                        <form action="{{ route('admin.delete', ['user' => $user->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
