<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h1 class="avy awg awp axv">Files</h1>
                        <p class="lb awa axt">A list of all the files</p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">File name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>1</td>
                                <td>My PDF</td>
                                <td>
                                    <a href="{{ route('files.generate-pdf') }}" class="btn btn-primary">View</a>
                                    @role('user')
                                        <a href=""
                                        class="btn btn-primary">Sign</a>
                                    @endrole
                                        

                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
