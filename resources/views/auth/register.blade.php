<x-layout.auth>
    @vite('resources/js/auth-register.js')
    @vite('resources/css/register.scss')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        select,
        option {
            background: #710e0e00 !important;
            border: 1px solid #710e0e00 !important;
        }

        .js-left-step.active svg {
            color: #5956e9;
        }

        .js-left-step.done svg {
            color: #3dd598 !important;
        }

        .js-left-step.wait {
            opacity: 0.5;
        }
    </style>
    <main>
        <background>
            <img src="{{ asset('img/auth/register-right.webp') }}">
        </background>
        <left>
            <section>
                <logo>
                    <img src="{{ asset('img/global/logo-dark.svg') }}">
                </logo>
                <steps>
                    <step class="js-left-step" data-step="-1">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Sign Wallet
                            </span>
                        </title_p>
                        <title_s>
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="0">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                identity information
                            </span>
                        </title_p>
                        <title_s>
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="1">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Educational Information
                            </span>
                        </title_p>
                        <title_s>
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="2">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Occupation and skills
                            </span>
                        </title_p>
                        <title_s>
                            Social network
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="3">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Social media
                            </span>
                        </title_p>
                        <title_s>
                            Your social media accounts
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="4">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Terms and conditions
                            </span>
                        </title_p>
                        <title_s>
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                    <step class="js-left-step" data-step="5">
                        <title_p>
                            <x-far-circle-check></x-far-circle-check>
                            <span>
                                Sign Wallet
                            </span>
                        </title_p>
                        <title_s>
                            Secure Your Identity with Auth
                        </title_s>
                    </step>
                </steps>
            </section>
        </left>
        <right>
            @if ($errors->any())
                <errors role="alert">
                    <strong>Validation Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <span onclick="document.querySelector('errors').style.display = 'none';">
                        <x-fas-times></x-fas-times>
                    </span>
                </errors>
            @endif
            <form id="theform" method="post" action="{{ route('walletconnect.register') }}">
                @csrf
                <heading>
                    <secondary>
                        GET STARTED</secondary>
                    <orginal>
                        Apply for Million Chance to Get Dreams Job</orginal>
                </heading>
                <page class="js-section-page" data-page="0">
                    <input type="hidden" name="birthday" class="js-real-birthday">
                  
                    <input type="hidden" name="inviter_email" value="">
                    <input type="hidden" name="is_fee_paid">
                    <script>
                        document.querySelector('[name="inviter_email"]').value = localStorage.getItem('js_inviter_email')
                        document.querySelector('[name="is_fee_paid"]').value = localStorage.getItem('js_is_fee_paid')
                    </script>
                    <type>
                        <label>Account type : </label>
                        <span>Invidual</span>
                        <a href="{{ route('walletconnect.showRegistrationForm_corp', ['wallet_address' => $wallet_address]) }}">
                            <circle></circle>
                        </a>
                        <span>Goverment / Corporation</span>
                    </type>
                    <fields>
                        <fullname>
                            <firstname>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <input placeholder="First name" name="first_name" type="text" value="{{ old('first_name') }}" />
                            </firstname>
                            <lastname>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <input placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                            </lastname>
                        </fullname>
                        <email>
                            <column>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <input placeholder="Your Email" name="email" value="{{ old('email') }}">
                            </column>
                        </email>
                        <bithday>
                            <label><span>
                                    <reqire>*</reqire>
                                    <i></i>Birthday
                                </span>
                            </label>
                            <year>
                                <select class="js_select_year" name="js_year">
                                </select>
                            </year>
                            <month>
                                <select class="js_select_month" name="js_month">
                                </select>
                            </month>
                            <day>
                                <select class="js_select_day" name="">
                                </select>
                            </day>
                        </bithday>
                        <nationality class="js-section-nationality">
                            <label>
                                <reqire>*</reqire>
                                <span>
                                    <i></i>
                                </span>
                                <text>Nationality</text>
                            </label>
                            <country>
                                <select name="country_primary" value="{{ old('country-primary') }}" class="js-select-nationality-country">
                                    <option value="0">Select Country</option>
                                </select>
                            </country>
                            <city>
                                <select name="state_primary" value="{{ old('state-primary') }}" class="js-select-nationality-state">
                                    <option value="0">Select State</option>
                                </select>
                            </city>
                            <action>
                                <button type="button" class="js-btn-add-nationality">
                                    <icon>
                                        <x-fas-plus></x-fas-plus>
                                    </icon>
                                </button>
                            </action>
                        </nationality>
                        <nationality_sec class="js-section-nationality-secondray" style="display: none">
                            <label>
                                <span>
                                    <icon>
                                        <x-fas-plus></x-fas-plus>
                                    </icon>
                                </span>
                                <text>Nationality</text>
                            </label>
                            <country>
                                <select name="country_secondary" value="{{ old('country-secondary') }}" class="js-select-nationality-country_secondary">
                                    <option value="0">Select Country</option>
                                </select>
                            </country>
                            <city>
                                <select name="state_secondary" value="{{ old('state-secondary') }}" class="js-select-nationality-state_secondary">
                                    <option value="0">Select State</option>
                                </select>
                            </city>
                            <action>
                                <button type="button" class="js-btn-remove-nationality">
                                    <icon>
                                        <x-fas-minus></x-fas-minus>
                                    </icon>
                                </button>
                            </action>
                        </nationality_sec>
                        <gender>
                            <label><span>
                                    <reqire>*</reqire>

                                    <i></i>Gender
                                </span>
                            </label>
                            <female>
                                <label><span>Female</span>
                                    <form__fields__row__col__input>
                                        <input type="radio" name="gender" value="female">
                                    </form__fields__row__col__input>
                                </label>
                            </female>
                            <male>
                                <label><span>Male</span>
                                    <form__fields__row__col__input>
                                        <input type="radio" name="gender" value="male">
                                    </form__fields__row__col__input>
                                </label>
                            </male>
                            <other>
                                <label><span>Other</span>
                                    <form__fields__row__col__input>
                                        <input type="radio" name="gender" value="other">
                                    </form__fields__row__col__input>
                                </label>
                            </other>
                        </gender>
                        <wallet>
                            <column>
                                <reqire>*</reqire>

                                <icon><i></i></icon>
                                <input readonly="" class="js-input-wallet-address" placeholder="Wallet address" name="wallet" value="{{ old('wallet') }}">
                                <wrong class="js-btn-not-you">
                                    not you? </wrong>
                            </column>
                        </wallet>
                    </fields>
                    <trms>
                        The terms and conditions will be shown in the last step.</trms>
                </page>
                <page class="js-section-page" data-page="1">
                    <education data-section="0" class="js-section-education">
                        <collage>
                            <country>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <select data-section="0" id="id-select-uni-country" class="js-select-uni-country" placeholder="Field of study" name="edu_country[]">
                                    <option value="0">
                                        Country</option>
                                </select>
                            </country>
                            <univercity>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <select data-section="0" class="js-select-uni" placeholder="Univercity / Collage " name="edu_univercity[]">
                                    <option value="0">
                                        Univercity / Collage
                                    </option>
                                </select>
                            </univercity>
                            <action>
                                <button type="button" class="js-add-education">
                                    <i class="fa-solid fa-plus "></i>
                                    <span>More</span>
                                </button>
                                <button type="button" style="display: none" class="js-remove-education">
                                    <i class="fa-solid fa-minus "></i>
                                    <span>Remove</span>
                                </button>
                            </action>
                        </collage>
                        <degree>
                            <field>
                                <reqire>*</reqire>
                                <icon>
                                    <i></i>
                                </icon>
                                <input placeholder="Field of Study" name="edu_field[]">
                            </field>
                            <type>
                                <reqire>*</reqire>
                                <icon><i></i></icon>
                                <input placeholder="Degree " name="edu_degree[]">
                            </type>
                        </degree>
                    </education>
                </page>
                <page class="js-section-page" data-page="2">
                    <grid>
                        <job>
                            <heading>Job information</heading>
                            <profession data-section="0" class="js-section-profession">
                                <column>
                                    <reqire>*</reqire>
                                    <icon><i></i></icon>
                                    <input placeholder="Profession" name="profession[]">
                                </column>
                                <column>
                                    <button type="button" class="js-btn-profession">
                                        More
                                        <x-fas-plus>
                                        </x-fas-plus>
                                    </button>
                                    <button style="display: none" type="button" class="js-btn-profession-remove">
                                        Delete
                                        <x-fas-minus>
                                        </x-fas-minus>
                                    </button>
                                </column>
                            </profession>
                            <skill data-section="0" class="js-section-skill">
                                <column>
                                    <reqire>*</reqire>
                                    <icon><i></i></icon>
                                    <input placeholder="Skill" name="skill[]">
                                </column>
                                <column>
                                    <button type="button" class="js-btn-skill">
                                        More
                                        <x-fas-plus>
                                        </x-fas-plus>
                                    </button>
                                    <button style="display: none" type="button" class="js-btn-skill-remove">
                                        Delete
                                        <x-fas-minus>
                                        </x-fas-minus>
                                    </button>
                                </column>
                            </skill>
                            <language data-section="0" class="js-section-language">
                                <column>
                                    <reqire>*</reqire>
                                    <icon><i></i></icon>
                                    <select class="js-select-language" placeholder="language" name="language[]">
                                        <option value="0">language</option>
                                    </select>
                                </column>
                                <column>
                                    <button type="button" class="js-btn-language">
                                        More
                                        <x-fas-plus>
                                        </x-fas-plus>
                                    </button>
                                    <button style="display: none" type="button" class="js-btn-language-remove">
                                        Delete
                                        <x-fas-minus>
                                        </x-fas-minus>
                                    </button>
                                </column>
                            </language>
                        </job>
                        <cv>
                            <heading>About you</heading>
                            <textarea name="cv" value="{{ old('cv') }}"></textarea>
                        </cv>
                    </grid>
                </page>
                <page class="js-section-page " data-page="3">
                    <socialmedia>
                        <heading>Social Media Links</heading>
                        <website_label>Website</website_label>
                        <website>
                            <icon><i></i></icon>
                            <input placeholder="Enter your website URL" name="website" value="{{ old('website') }}">
                        </website>
                        <facebook_label>Facebook</facebook_label>
                        <facebook>
                            <icon><i></i></icon>
                            <input placeholder="Enter your Facebook username" name="facebook" value="{{ old('facebook') }}">
                        </facebook>
                        <twitter_label>Twitter</twitter_label>
                        <twitter>
                            <icon><i></i></icon>
                            <input placeholder="Enter your Twitter username" name="twitter" value="{{ old('twitter') }}">
                        </twitter>
                        <instagram_label>Instagram</instagram_label>
                        <instagram>
                            <icon><i></i></icon>
                            <input placeholder="Enter your Instagram username" name="instagram" value="{{ old('instagram') }}">
                        </instagram>
                        <linkedin_label>LinkedIn</linkedin_label>
                        <linkedin>
                            <icon><i></i></icon>
                            <input placeholder="Enter your LinkedIn username" name="linkedin" value="{{ old('linkedin') }}">
                        </linkedin>
                        <youtube_label>YouTube</youtube_label>
                        <youtube>
                            <icon><i></i></icon>
                            <input placeholder="Enter your YouTube channel URL" name="youtube" value="{{ old('youtube') }}">
                        </youtube>
                        <telegram_label>Telegram</telegram_label>
                        <telegram>
                            <icon><i></i></icon>
                            <input placeholder="Enter your Telegram username" name="telegram" value="{{ old('telegram') }}">
                        </telegram>
                    </socialmedia>
                </page>
                <page class="js-section-page" data-page="4">
                    <terms>
                        <heading>
                            <h1>Terms and Conditions</h1>
                        </heading>
                        <content>
                            The user agrees to comply with all applicable laws and regulations while using the site.
                            The user must be at least 13 years of age or have parental consent to use the site.
                            The user agrees not to post any content that is harmful, offensive, or infringes on the
                            rights of
                            others.
                            The site reserves the right to remove any content that violates its policies or is deemed
                            inappropriate.
                            The user agrees not to use the site for spamming, phishing, or other malicious activities.
                            The user is responsible for maintaining the security of their account and password.
                            The site is not responsible for any loss or damage resulting from the use of the site.
                            The user agrees to indemnify and hold harmless the site and its owners from any claims
                            arising out
                            of their use of the site.
                            The site may suspend or terminate a user's account for any violation of these terms.
                            The user agrees to the site's privacy policy and acknowledges that their personal
                            information may be
                            collected and used for various purposes.
                        </content>
                    </terms>
                </page>
                <buttons>
                    <button type="button" class="js-btn-prev  btn btn-neutral">
                        <span>Back</span>
                    </button>
                    <button type="button" class="js-btn-next btn btn-primary">
                        <span>Next step</span>
                    </button>
                    <button type="submit" class="js-btn-submit  btn btn-primary">
                        <span>submit</span>
                    </button>
                </buttons>
            </form>
        </right>
    </main>


</x-layout.auth>
