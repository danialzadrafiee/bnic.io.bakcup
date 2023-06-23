@vite('resources/js/modal_publicity_edit.js')

@php
    $columns = Schema::getColumnListing('users');
    $i_pub_cols = new stdClass();
    foreach ($columns as $column) {
        if (Str::startsWith($column, 'i_pub_')) {
            $i_pub_cols->$column = Auth::user()->$column;
        }
    }
@endphp

<dialog id="modal_publicity_edit" class="modal" >
    <form method="dialog" class="modal-box" >
        <h3 class="font-semibold block px-8 text-lg">Edit Profile Publicity</h3>
        <div class="divider px-8"></div>
        {{-- Content --}}
        <content class="js-publicity-data block px-8">
            <input type="hidden" name="id" class="js-publicity-toggle" value="{{ auth()->user()->id }}">
            <table class="table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th class="float-right">Publicity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>First name</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_first_name" value="{{ $i_pub_cols->i_pub_first_name }}" {{ $i_pub_cols->i_pub_first_name ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_last_name" value="{{ $i_pub_cols->i_pub_last_name }}" {{ $i_pub_cols->i_pub_last_name ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Birthday</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_birthday" value="{{ $i_pub_cols->i_pub_birthday }}" {{ $i_pub_cols->i_pub_birthday ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Country primary</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_country_primary" value="{{ $i_pub_cols->i_pub_country_primary }}" {{ $i_pub_cols->i_pub_country_primary ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>State primary</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_state_primary" value="{{ $i_pub_cols->i_pub_state_primary }}" {{ $i_pub_cols->i_pub_state_primary ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Country secondary</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_country_secondary" value="{{ $i_pub_cols->i_pub_country_secondary }}" {{ $i_pub_cols->i_pub_country_secondary ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>State_secondary</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_state_secondary" value="{{ $i_pub_cols->i_pub_state_secondary }}" {{ $i_pub_cols->i_pub_state_secondary ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Education country</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_edu_country" value="{{ $i_pub_cols->i_pub_edu_country }}" {{ $i_pub_cols->i_pub_edu_country ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Education univercity</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_edu_univercity" value="{{ $i_pub_cols->i_pub_edu_univercity }}" {{ $i_pub_cols->i_pub_edu_univercity ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Education field</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_edu_field" value="{{ $i_pub_cols->i_pub_edu_field }}" {{ $i_pub_cols->i_pub_edu_field ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Education degree</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_edu_degree" value="{{ $i_pub_cols->i_pub_edu_degree }}" {{ $i_pub_cols->i_pub_edu_degree ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Profession</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_profession" value="{{ $i_pub_cols->i_pub_profession }}" {{ $i_pub_cols->i_pub_profession ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Skill</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_skill" value="{{ $i_pub_cols->i_pub_skill }}" {{ $i_pub_cols->i_pub_skill ? 'checked' : '' }} /></td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td><input type="checkbox" class="js-publicity-toggle toggle toggle-accent float-right" name="i_pub_language" value="{{ $i_pub_cols->i_pub_language }}" {{ $i_pub_cols->i_pub_language ? 'checked' : '' }} /></td>
                    </tr>
                </tbody>
            </table>
        </content>
        {{-- Actions --}}
        <div class="modal-action px-8">
            <button class="btn normal-case btn-neutral" type="submit">Close</button>
            <button class="js-btn-publicity-submit btn normal-case btn-primary" type="button">Save changes</button>
        </div>
    </form>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
