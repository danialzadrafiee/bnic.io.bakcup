<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\Fake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $usertoken = 10000;
        // invidual
        for ($i = 0; $i < 2; $i++) {
            DB::table('users')->insert([
                'birthday' => fake()->date(),
                'country_primary' => fake()->countryCode(),
                'country_secondary' => fake()->countryCode(),
                'created_at' => fake()->date(),
                'cv' => fake()->paragraphs(4, true),
                'edu_country' => '["' . fake()->countryCode() . '","' . fake()->countryCode() . '"]',
                'edu_degree' => '["Temporibus ullam ","Magna et suscipit "]',
                'edu_field' => '["Id inventore","Eos maiores officia"]',
                'edu_univercity' => '["Southern Medical Europe","Asian Medical Institute"]',
                'email' => fake()->email(),
                'facebook' => fake()->userName(),
                'first_name' => fake()->firstName(),
                'gender' => 'male',
                'id' => fake()->numberBetween(1, 999999),
                'instagram' => fake()->userName(),
                'language' => '["ia","en"]',
                'last_name' => fake()->lastName(),
                'linkedin' => fake()->userName(),
                'profession' => '["Sit facilis voluptas","Sit irure cupidatat"]',
                'state_primary' => '04',
                'state_secondary' => 'VI',
                'telegram' => fake()->userName(),
                'twitter' => fake()->userName(),
                'updated_at' => '2023-04-27 18:22:06',
                'user_type' => 'invidual',
                'wallet' => '0x9211676A80f6F8a07d55c1A4D9755b992ee' . fake()->numberBetween(1000, 9999),
                'website' => fake()->url(),
                'youtube' => fake()->userName(),
                "token" => ++$usertoken,
            ]);
        }
        for ($i = 0; $i < 2; $i++) {
            DB::table('users')->insert([
                'user_type' => 'corporation',
                'corp_cat_pri' => 'financial',
                'corp_cat_sec' => 'Investment Management',
                'corp_country_pri' => fake()->countryCode(),
                'corp_country_sec' => fake()->countryCode(),
                'corp_cv' =>  fake()->paragraphs(4, true),
                'corp_establishment' => fake()->date(),
                'corp_form' => 'classic',
                'corp_name' => fake()->company(),
                'corp_state_pri' => fake()->countryCode(),
                'corp_state_sec' => fake()->countryCode(),
                'corp_type' => 'corporation',
                'created_at' => fake()->date(),
                'email' => fake()->email(),
                'facebook' => fake()->userName(),
                'instagram' => fake()->userName(),
                'wallet' => '0xGR2z676A80f6F8a07d55c1A4D9755b992ee' . fake()->numberBetween(1000, 9999),
                'website' =>  fake()->url(),
                'youtube' => fake()->userName(),
                "token" => ++$usertoken,
            ]);
        }
        // danial invidual
        $danial = [

            'birthday' => '1993-04-30',
            'country_primary' => 'IR',
            'country_secondary' => 'US',
            'state_primary' => '23',
            'state_secondary' => '1',
            'created_at' => '2023-05-28 10:33:00',
            'cv' => 'Highly skilled and motivated web developer with 5 years of experience in designing and developing responsive websites and web applications. Proficient in HTML, CSS, JavaScript, and various front-end frameworks. Strong problem-solving abilities and a passion for creating user-friendly and visually appealing websites. Committed to delivering high-quality code and meeting project deadlines.',
            'edu_country' => '["BH","BD"]',
            'edu_univercity' => '["Bahrain Polytechnic","City University"]',
            'edu_degree' => '["PHD","GOD"]',
            'edu_field' => '["Psychoanalysis","Math"]',
            'email' => 'subdanial@gmail.com',
            'first_name' => 'danial',
            'gender' => 'male',
            'id' => '702612',
            'language' => '["bh","en"]',
            'last_name' => 'rafiee',
            'profession' => '["psychologist","Developer"]',
            'skill' => '["TA","PHP"]',
            'updated_at' => '2023-05-28 10:33:00',
            'user_type' => 'invidual',
            'wallet' => '0x9e5d516b80f94C55fc8061d9cacCfA98b585c8ee',
            'website' => 'https://www.jamofasyfa.mobi',
            "token" => ++$usertoken,

        ];
        //adler invidual
        $adler = [

            'birthday' => '1993-04-30',
            'country_primary' => 'IR',
            'country_secondary' => '0',
            'created_at' => '2023-05-28 10:33:00',
            'cv' => 'Highly skilled and motivated web developer with 5 years of experience in designing and developing responsive websites and web applications. Proficient in HTML, CSS, JavaScript, and various front-end frameworks. Strong problem-solving abilities and a passion for creating user-friendly and visually appealing websites. Committed to delivering high-quality code and meeting project deadlines.',
            'edu_country' => '["AX"]',
            'edu_degree' => '["PHD"]',
            'edu_field' => '["Pianist"]',
            'edu_univercity' => '["NO"]',
            'email' => 'adler@gmail.com',
            'first_name' => 'Adler',
            'gender' => 'male',
            'id' => '702613',
            'language' => '["bh"]',
            'last_name' => 'Velli',
            'profession' => '["Developer"]',
            'skill' => '["Javascript"]',
            'state_primary' => '23',
            'state_secondary' => '0',
            'updated_at' => '2023-05-28 10:33:00',
            'user_type' => 'invidual',
            'wallet' => '0x5A4dDeB3911c24edAe11823123Cd8D7dA57Cafb6',
            'website' => 'https://www.jamofasyfa.mobi',
            "token" => ++$usertoken,

        ];

        //developerpie corporation
        $developerpie = [
            'corp_cat_pri' => 'educational',
            'corp_cat_sec' => 'K-12 Education',
            'corp_country_pri' => 'IR',
            'corp_country_sec' => '0',
            'corp_cv' => 'DeveloperPie Web Solutions is a dynamic web development corporation that specializes in creating visually stunning and highly functional websites for businesses of all sizes. With a passion for creativity and a focus on delivering exceptional user experiences, DeveloperPie takes pride in building websites that stand out in today\'s competitive online landscape.\n\nMission:\nAt DeveloperPie Web Solutions, our mission is to empower businesses with impressive online presence through captivating and user-friendly websites. We believe that every website should be a reflection of the brand\'s unique identity while providing seamless functionality to engage and convert visitors. Our team of talented developers is dedicated to delivering top-notch web solutions that leave a lasting impression',
            'corp_establishment' => '2021-03-06',
            'corp_form' => 'classic',
            'corp_name' => 'DeveloperPie',
            'corp_state_pri' => '23',
            'corp_state_sec' => '0',
            'corp_type' => 'corporation',
            'created_at' => '2023-05-28 10:47:22',
            'email' => 'info@developerpie.com',
            'id' => '702614',
            'updated_at' => '2023-05-28 10:47:22',
            'user_type' => 'corporation',
            'wallet' => '0x63a3E8613ae36e2Cbbb8Dc6f4427BE38C18Bc596',
            'website' => 'https://developerpie.com',
            "token" => ++$usertoken,
        ];

        function callSeedCat($user)
        {
            $controller = app()->make(\App\Http\Controllers\WalletConnectController::class);
            $controller->seed_cat($user);
        }

        $danial_user = User::create($danial);
        callSeedCat($danial_user);
        $adler_user = User::create($adler);
        callSeedCat($adler_user);
        $developerpie_user = User::create($developerpie);
        callSeedCat($developerpie_user);




        //document
        $certToken = 3000;
        $documentToken = 2000;
        $document = [
            'content' => '<div class="flex flex-col space-y-4">
                            <div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-1"><div class="js-element p-2 rounded" data-field-id="f_2">
                                    <h3 class="js-editable-element text-xl font-semibold">Heading</h3>
                                </div><div class="js-element p-2 rounded" data-field-id="f_3">
                                    <p class="js-editable-element">This is a simple form creator that allows you to drag and drop form elements
                    into a form
                    creator. You can also edit the form elements and add them to the form creator</p>
                                </div></div><div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-2"><field class="js-element p-2 flex flex-col rounded" data-field-id="f_1" data-publicity-creator="false" data-publicity-reciver="false">
                                    <input name="Firstname" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="Firstname">
                                    <publicity class="set-publicity -mt-8 w-max py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>
                                </field><field class="js-element p-2 flex flex-col rounded" data-field-id="f_2" data-publicity-creator="false" data-publicity-reciver="true">
                                    <input name="Lastname" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="Lastname">
                                    <publicity class="set-publicity -mt-8 w-max py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>
                                </field></div><div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-1"><field class="js-element p-2 flex flex-col rounded" data-field-id="f_1" data-publicity-creator="false" data-publicity-reciver="true">
                                    <input name="@Username" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="@Username">
                                    <publicity class="set-publicity -mt-8 w-max py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>
                                </field><field class="js-element p-2 flex flex-col rounded" data-field-id="f_2" data-publicity-creator="true" data-publicity-reciver="true">
                                    <textarea name="About" placeholder="About" id="" class="w-full py-3 px-2 border-neutral/50 rounded"></textarea>
                                    <publicity class="set-publicity -mt-8 w-max py-2">
                                        <div class="flex">
                                            <label class="block px-4 ">Publicity : </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-2-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Creator
                                                </div>
                                            </label>
                                            <label class="flex items-center mr-4">
                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">
                                                <div for="inline-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">
                                                    Reciver</div>
                                            </label>
                                        </div>
                                    </publicity>
                                </field></div></div>',
            'corporation_id' => '702614',
            'created_at' => '2023-05-28 10:54:57',
            'description' => 'Random description for default form',
            'id' => '2',
            'image' => 'https://api.dicebear.com/6.x/shapes/svg?seed=sdsaf',
            'name' => 'Default Form',
            'reciver' => 'adler@gmail.com',
            "token" => ++$documentToken,
            'updated_at' => '2023-05-28 10:54:57',
        ];
        //cert_sign
        $sign_cert = [
            'id' => '1',
            'category_id' => 1,
            'user_id' => '702612',
            'document_id' => '2',
            'corporation_id' => '702614',
            'name' => 'Default Form',
            'description' => 'Random description for default form',
            'image' => 'https://api.dicebear.com/6.x/shapes/svg?seed=ddasq',
            'data' => '<div class="flex flex-col space-y-4">                            <div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-1"><div class="js-element p-2 rounded" data-field-id="f_2">                                    <h3 class="js-editable-element text-xl font-semibold">Heading</h3>                                </div><div class="js-element p-2 rounded" data-field-id="f_3">                                    <p class="js-editable-element">This is a simple form creator that allows you to drag and drop form elements                    into a form                    creator. You can also edit the form elements and add them to the form creator</p>                                </div></div><div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-2"><field class="js-element p-2 flex flex-col rounded" data-field-id="f_1" data-publicity-creator="false" data-publicity-reciver="false">                                    <input name="Firstname" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="Firstname" value="Danial">                                    <publicity class="set-publicity -mt-8 w-max py-2 hidden">                                        <div class="flex">                                            <label class="block px-4 ">Publicity : </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Creator                                                </div>                                            </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Reciver</div>                                            </label>                                        </div>                                    </publicity>                                </field><field class="js-element p-2 flex flex-col rounded" data-field-id="f_2" data-publicity-creator="false" data-publicity-reciver="true">                                    <input name="Lastname" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="Lastname" value="Rafiee">                                    <publicity class="set-publicity -mt-8 w-max py-2 hidden">                                        <div class="flex">                                            <label class="block px-4 ">Publicity : </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Creator                                                </div>                                            </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Reciver</div>                                            </label>                                        </div>                                    </publicity>                                </field></div><div class="js-row grid gap-2 min-h-[40px] relative my-2 grid-cols-1"><field class="js-element p-2 flex flex-col rounded" data-field-id="f_1" data-publicity-creator="false" data-publicity-reciver="true">                                    <input name="@Username" class="appearance-none border-neutral/50 rounded w-full py-3 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="text" type="text" placeholder="@Username" value="Subdanial">                                    <publicity class="set-publicity -mt-8 w-max py-2 hidden">                                        <div class="flex">                                            <label class="block px-4 ">Publicity : </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-2-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Creator                                                </div>                                            </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-checkbox" class=" ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Reciver</div>                                            </label>                                        </div>                                    </publicity>                                </field><field class="js-element p-2 flex flex-col rounded" data-field-id="f_2" data-publicity-creator="true" data-publicity-reciver="true">                                    <textarea name="About" placeholder="About" id="" class="w-full py-3 px-2 border-neutral/50 rounded">git config --global user.name</textarea>                                    <publicity class="set-publicity -mt-8 w-max py-2 hidden">                                        <div class="flex">                                            <label class="block px-4 ">Publicity : </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="creator" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-2-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Creator                                                </div>                                            </label>                                            <label class="flex items-center mr-4">                                                <input type="checkbox" value="reciver" class="js-publicity-checkbox w-4 h-4 text-blue-600 bg-neutral-100 border-neutral-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600">                                                <div for="inline-checkbox" class="ml-2 text-sm font-medium text-neutral-900 dark:text-neutral-300">                                                    Reciver</div>                                            </label>                                        </div>                                    </publicity>                                </field></div></div>',
            'reciver' => 'adler@gmail.com',
            'reciver_verify' => '1',
            'creator_verify' => '1',
            'ad_email' => '["adler@gmail.com"]',
            'ad_role' => '["admin"]',
            'ad_describe' => '["No Describe"]',
            "token" => ++$certToken,
            'created_at' => '2023-05-28 12:46:27',
            'updated_at' => '2023-05-28 12:46:27',
        ];
        DB::table('documents')->insert($document);
        DB::table('sign_certs')->insert($sign_cert);
        $sign_cert['id'] = 2;
        $sign_cert['image'] = 'https://api.dicebear.com/6.x/shapes/svg?seed=aaaa';
        $sign_cert['name'] = 'second form';
        $sign_cert['category_id'] = '2';
        DB::table('sign_certs')->insert($sign_cert);


        $eventToken = 4000;
        // Generate events
        $userId = 702612; //danial
        foreach (range(25, 10) as $index) {
            $eventType = fake()->randomElement(['private', 'public']);
            $event = DB::table('events')->insertGetId([
                'user_id' => fake()->randomElement([$userId, fake()->randomNumber(6)]),
                'type' => $eventType,
                'title' => fake()->sentence(5),
                'image' => fake()->imageUrl(),
                'content' => fake()->paragraph(),
                'created_at' => fake()->dateTimeThisMonth(),
                "token" => ++$eventToken,
            ]);
            // Only attach the event to the user if the event type is private
            if ($eventType == 'private') {
                DB::table('event_user')->insert([
                    'user_id' => fake()->randomElement([$userId, fake()->randomNumber(6)]),
                    'event_id' => $event,
                ]);
            }
        }
    } //<- put seeds before this
}
