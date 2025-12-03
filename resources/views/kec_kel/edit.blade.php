<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Edit Kecamatan / Kelurahan</h2>

    <form action="{{ route('kec_kel.update', $data->id_kec_kel) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kecamatan / Kelurahan</label>
        <input type="text" name="nama_kec_kel" value="{{ $data->nama_kec_kel }}" class="border p-2 w-full" required>

        <button class="mt-4 px-4 py-2 bg-blue-600 text-black rounded">Update</button>
    </form>
</x-app-layout>
