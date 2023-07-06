<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<dialog id="edit_profile_picture" class="modal" >
    <form method="dialog" class="modal-box h-max" >
        <flex class="flex items-end gap-2">
            <cel>
                <img src="{{ $user->profile_picture }}" class="rounded-lg w-12 h-12" alt="avatar">
            </cel>
            <cel>
                <h3 class="font-medium text-lg">Update profile picture</h3>
                <small class="text-neutral-5">You can change your profile picture anytime</small>
            </cel>
        </flex>
        <div class="py-4">
            <input type="file" class="js_profile_picture_file_input">
        </div>
        <div class="modal-action">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn btn-neutral">Cancel</button>
            <button type="button" class="js_update_picture btn btn-primary btn-disabled opacity-50">Update</button>
        </div>
    </form>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>



public function update(Request $request)
{
    $user = User::find($request->id);
    $user->update($request->all());
    $user->save();
    return response()->json($user);
}