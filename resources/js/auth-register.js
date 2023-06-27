import Papa from "papaparse"

let currentPage = 0

var input_rules = {
    // page 0
    first_name: [["isLength", 3]],
    last_name: [["isLength", 3]],
    email: [["isLength", 3], ["isEmail"]],
    js_year: [["isLength", 4]],
    js_month: [["isInt", { min: 1, max: 12 }]],
    js_day: [["isInt", { min: 1, max: 32 }]],
    birthday: [["isDate"]],
    country_primary: [["isAlpha"]],
    state_primary: [["isLength", 1]],
    country_secondary: [["isAlpha"]],
    state_secondary: [["isLength", 3]],
    gender: [["isLength", 3]],
    wallet: [["isLength", 3]],
    profession: [["isLength", 3]],
    skill: [["isLength", 3]],
    language: [["isLength", 3]],
    cv: [["isLength", 3]],
    website: [["isLength", 3]],
    facebook: [["isLength", 3]],
    twitter: [["isLength", 3]],
    instagram: [["isLength", 3]],
    linkedin: [["isLength", 3]],
    youtube: [["isLength", 3]],
    telegram: [["isLength", 3]],
    // page1
    "edu_country[]": [["isAlpha"]],
    "edu_univercity[]": [["isAlpha"]],
    "edu_field[]": [["isLength", 3]],
    "edu_degree[]": [["isLength", 3]],
    // page2
    "profession[]": [["isLength", 3]],
    "skill[]": [["isLength", 3]],
    "language[]": [["isAlpha"]],
}

window.valid_page_0 = {
    first_name: false,
    last_name: false,
    email: false,
    js_year: true,
    js_month: true,
    js_day: true,
    birthday: true,
    country_primary: false,
    state_primary: false,
    country_secondary: true,
    state_secondary: true,
    gender: false,
}
window.valid_page_1 = {
    "edu_country[]": false,
    "edu_univercity[]": false,
    "edu_field[]": false,
    "edu_degree[]": false,
}
window.valid_page_2 = {
    "profession[]": false,
    "skill[]": false,
    "language[]": false,
}

let elements = document.querySelectorAll("*")
elements.forEach(function (element) {
    element.addEventListener("change", pageValidCheck)
    element.addEventListener("click", pageValidCheck)
    element.addEventListener("keyup", pageValidCheck)
    element.addEventListener("keydown", pageValidCheck)
})
let hasFalseValue = true
let entries = Object.entries(valid_page_0)
pageValidCheck("load")
function pageValidCheck(event) {
    if (currentPage <= 6) {
        let validPage = window["valid_page_" + currentPage]
        if (validPage) {
            let entries = Object.entries(validPage)
            let hasFalseValue = entries.some(([key, value]) => value === false)
            if (hasFalseValue) {
                console.log(entries)
                $(".js-btn-next").addClass("btn-disabled").prop("disabled", true)
            } else {
                $(".js-btn-next").removeClass("btn-disabled").prop("disabled", false)
            }
        }
    }
}

import validator from "validator"

let normal_error_class = "!border-b-accent-4 !relative placeholder-accent-4 text-accent-4"
function normal_validateInput(inputName, rule) {
    var inputValue = $(`[name="${inputName}"]`).val()
    let isValid = false
    if (rule.length == 2) {
        isValid = validator[rule[0]](inputValue, rule[1])
    }
    if (rule.length == 1) {
        isValid = validator[rule[0]](inputValue)
    }
    return isValid
}

for (let prop in input_rules) {
    if (input_rules.hasOwnProperty(prop)) {
        const value = input_rules[prop]
        let input = $(`[name="${prop}"]`)
        input.on("change", function () {
            let isValid = value.map((rule) => normal_validateInput(prop, rule))
            let pageIsValid = !isValid.includes(false)
            input.toggleClass(normal_error_class, !pageIsValid)
            if (currentPage <= 6) {
                let validPage = window["valid_page_" + currentPage]
                if (validPage) {
                    validPage[prop] = pageIsValid
                }
            }
        })
    }
}

function pageManager() {
    $(".js-btn-prev").css("display", currentPage === 0 ? "none" : "")
    $(".js-btn-next").css("display", currentPage === $(".js-section-page").length - 1 ? "none" : "")
    $(".js-btn-submit").css("display", currentPage === $(".js-section-page").length - 1 ? "" : "none")
    $(".js-section-page").each(function () {
        $(this).css("display", $(this).data("page") !== currentPage ? "none" : "")
    })
    $("step").each(function (e) {
        if ($(this).data("step") == currentPage) {
            $(this).removeClass()
            $(this).addClass("js-left-step")
            $(this).addClass("active")
        } else {
            if ($(this).data("step") < currentPage) {
                $(this).removeClass()
                $(this).addClass("js-left-step")
                $(this).addClass("done")
            }
            if ($(this).data("step") > currentPage) {
                $(this).removeClass()
                $(this).addClass("js-left-step")
                $(this).addClass("wait")
            }
        }
    })
    $(".js-section-page").trigger("input")
}

pageManager()
fillYearOptions()
fillMonthOptions()
updateDays()

const walletAddress = new URLSearchParams(window.location.search).get("wallet_address")
$(".js-input-wallet-address").val(walletAddress)
function fillYearOptions() {
    const currentYear = new Date().getFullYear()
    for (let i = currentYear; i >= currentYear - 100; i--) {
        const option = $("<option>").val(i).text(i)
        $(".js_select_year").append(option)
    }
}
function fillMonthOptions() {
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]

    monthNames.forEach((month, index) => {
        const option = $("<option>")
            .val(index + 1)
            .text(month)
        $(".js_select_month").append(option)
    })
}
function updateDays() {
    const selectedYear = parseInt($(".js_select_year").val())
    const selectedMonth = parseInt($(".js_select_month").val())
    const daysInMonth = new Date(selectedYear, selectedMonth, 0).getDate()
    $(".js_select_day").html("")
    for (let i = 1; i <= daysInMonth; i++) {
        const option = $("<option>").val(i).text(i)
        $(".js_select_day").append(option)
    }
}
function updateRealDate() {
    const year = parseInt($(".js_select_year").val())
    const month = parseInt($(".js_select_month").val())
    const day = parseInt($(".js_select_day").val())
    const twoDigitMonth = month < 10 ? "0" + month : month
    const twoDigitDay = day < 10 ? "0" + day : day
    const dateString = `${year}-${twoDigitMonth}-${twoDigitDay}`
    const realDate = new Date(dateString)

    const formattedDate = realDate.toISOString().slice(0, 10)
    $(".js-real-birthday").val(formattedDate)
}

let orgin = window.location.origin

const setCountries = async () => {
    try {
        const response = await axios.get(`${orgin}/json/countries_states.json`)
        const countries = response.data
        countries.forEach((country) => {
            const option = new Option(country.name, country.iso2)
            $(".js-select-nationality-country").append($(option).clone())
            $(".js-select-uni-country").append($(option).clone())
            $(".js-select-nationality-country_secondary").append(option)
        })
    } catch (error) {
        console.error(error)
    }
}
setCountries()

const setStatesBasedOnCountry = async (countryiso2, selector_class) => {
    try {
        const response = await axios.get("https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries%2Bstates.json")
        const countries = response.data

        const country = countries.find((country) => country.iso2 === countryiso2)

        if (country) {
            $(selector_class).empty()

            country.states.forEach((state) => {
                const option = new Option(state.name, state.id)
                $(selector_class).append($(option).clone())
            })

            if (country.states.length == 0) {
                const option = new Option("No States", "NO")
                $(selector_class).append($(option).clone())
            }
        }
    } catch (error) {
        console.error(error)
    }
}
updateDays()
updateRealDate()
$(".js_select_year").on("change", () => {
    updateDays()
    updateRealDate()
})
$(".js_select_month").on("change", () => {
    updateDays()
    updateRealDate()
})
$(".js-btn-next").on("click", () => {
    currentPage++
    pageManager()
})
$(".js-btn-prev").on("click", () => {
    currentPage--
    pageManager()
})

$(".js_select_day").on("change", updateRealDate)

$(".js-select-nationality-country").on("change", function () {
    const countryiso2 = $(this).val()
    setStatesBasedOnCountry(countryiso2, ".js-select-nationality-state")
})

$(".js-select-nationality-country_secondary").on("change", function () {
    const countryiso2 = $(this).val()
    setStatesBasedOnCountry(countryiso2, ".js-select-nationality-state_secondary")
})

$(".js-btn-add-nationality").on("click", function () {
    $(this).css("display", "none")
    $(".js-section-nationality-secondray").css("display", "grid")
})
$(".js-btn-remove-nationality").on("click", function () {
    $(".js-btn-add-nationality").css("display", "block")
    $(".js-section-nationality-secondray").css("display", "none")
})

$("body").on("change", ".js-select-uni-country", function () {
    let selected_country = $(this).find("option:checked").val()
    let data_section = $(this).data("section")
    let targetSelectUni = $(`.js-select-uni[data-section="${data_section}"]`)

    const csvUrl = "https://raw.githubusercontent.com/endSly/world-universities-csv/master/world-universities.csv"
    axios
        .get("https://raw.githubusercontent.com/endSly/world-universities-csv/master/world-universities.csv")
        .then((response) => {
            let parsed = Papa.parse(response.data, {
                delimiter: ",",
                header: false,
                skipEmptyLines: true,
            })
            if (parsed.data) {
                targetSelectUni.empty()
                let matchcount = 0
                parsed.data.forEach((row) => {
                    if (row[0] === selected_country) {
                        matchcount++
                        let option = $("<option>").val(row[0]).text(row[1])
                        targetSelectUni.append(option)
                    }
                })
                if (targetSelectUni.find("option").length == 0) {
                    let empty_option = $("<option>").val("NO").text("No University")
                    targetSelectUni.append(empty_option)
                }
            }
        })
        .catch((error) => {
            console.error(error)
            let option = $("<option>").val("Tehran Univercity").text("Tehran Univercity")
            targetSelectUni.append(option)
            option = $("<option>").val("Mashad Univercity").text("Mashad Univercity")
            targetSelectUni.append(option)
            option = $("<option>").val("Shiraz Univercity").text("Shiraz Univercity")
            targetSelectUni.append(option)
        })
})

$("body").on("click", ".js-add-education", function () {
    let elementEducation = $(".js-section-education").last().clone()
    elementEducation.attr("data-section", parseInt(elementEducation.attr("data-section")) + 1)
    elementEducation.find("[data-section]").attr("data-section", function () {
        return parseInt($(this).attr("data-section")) + 1
    })
    $(".js-section-education").last().after(elementEducation)
    $(".js-add-education:not(:last)").hide()
    $(".js-remove-education:not(:last)").show()
})
$("body").on("click", ".js-remove-education", function () {
    $(this).closest(".js-section-education").remove()
})

function manageSections(action, sectionClass, buttonClass, buttonRemoveClass) {
    $("body").on("click", buttonClass, function () {
        if (action === "add") {
            let section = $(sectionClass).last().clone()
            section.attr("data-section", parseInt(section.attr("data-section")) + 1)
            section.find("[data-section]").attr("data-section", function () {
                return parseInt($(this).attr("data-section")) + 1
            })
            $(sectionClass).last().after(section)
            $(buttonClass + ":not(:last)").hide()
            $(buttonRemoveClass + ":not(:last)").show()
        } else if (action === "remove") {
            $(this).closest(sectionClass).remove()
        }
    })
}

manageSections("add", ".js-section-profession", ".js-btn-profession", ".js-btn-profession-remove")
manageSections("remove", ".js-section-profession", ".js-btn-profession-remove")

manageSections("add", ".js-section-skill", ".js-btn-skill", ".js-btn-skill-remove")
manageSections("remove", ".js-section-skill", ".js-btn-skill-remove")

manageSections("add", ".js-section-language", ".js-btn-language", ".js-btn-language-remove")
manageSections("remove", ".js-section-language", ".js-btn-language-remove")

const langs = {
    aa: "Afar",
    ab: "Abkhazian",
    ae: "Avestan",
    af: "Afrikaans",
    ak: "Akan",
    am: "Amharic",
    an: "Aragonese",
    ar: "Arabic",
    as: "Assamese",
    av: "Avaric",
    ay: "Aymara",
    az: "Azerbaijani",
    ba: "Bashkir",
    be: "Belarusian",
    bg: "Bulgarian",
    bh: "Bihari languages",
    bi: "Bislama",
    bm: "Bambara",
    bn: "Bengali",
    bo: "Tibetan",
    br: "Breton",
    bs: "Bosnian",
    ca: "Catalan",
    ce: "Chechen",
    ch: "Chamorro",
    co: "Corsican",
    cr: "Cree",
    cs: "Czech",
    cu: "Church Slavic",
    cv: "Chuvash",
    cy: "Welsh",
    da: "Danish",
    de: "German",
    dv: "Maldivian",
    dz: "Dzongkha",
    ee: "Ewe",
    el: "Greek",
    en: "English",
    eo: "Esperanto",
    es: "Spanish",
    et: "Estonian",
    eu: "Basque",
    fa: "Persian",
    ff: "Fulah",
    fi: "Finnish",
    fj: "Fijian",
    fo: "Faroese",
    fr: "French",
    fy: "Western Frisian",
    ga: "Irish",
    gd: "Gaelic",
    gl: "Galician",
    gn: "Guarani",
    gu: "Gujarati",
    gv: "Manx",
    ha: "Hausa",
    he: "Hebrew",
    hi: "Hindi",
    ho: "Hiri Motu",
    hr: "Croatian",
    ht: "Haitian",
    hu: "Hungarian",
    hy: "Armenian",
    hz: "Herero",
    ia: "Interlingua",
    id: "Indonesian",
    ie: "Interlingue",
    ig: "Igbo",
    ii: "Sichuan Yi",
    ik: "Inupiaq",
    io: "Ido",
    is: "Icelandic",
    it: "Italian",
    iu: "Inuktitut",
    ja: "Japanese",
    jv: "Javanese",
    ka: "Georgian",
    kg: "Kongo",
    ki: "Kikuyu",
    kj: "Kuanyama",
    kk: "Kazakh",
    kl: "Kalaallisut",
    km: "Central Khmer",
    kn: "Kannada",
    ko: "Korean",
    kr: "Kanuri",
    ks: "Kashmiri",
    ku: "Kurdish",
    kv: "Komi",
    kw: "Cornish",
    ky: "Kirghiz",
    la: "Latin",
    lb: "Luxembourgish",
    lg: "Ganda",
    li: "Limburgan",
    ln: "Lingala",
    lo: "Lao",
    lt: "Lithuanian",
    lu: "Luba-Katanga",
    lv: "Latvian",
    mg: "Malagasy",
    mh: "Marshallese",
    mi: "Maori",
    mk: "Macedonian",
    ml: "Malayalam",
    mn: "Mongolian",
    mr: "Marathi",
    ms: "Malay",
    mt: "Maltese",
    my: "Burmese",
    na: "Nauru",
    nb: "Norwegian",
    nd: "North Ndebele",
    ne: "Nepali",
    ng: "Ndonga",
    nl: "Dutch",
    nn: "Norwegian",
    no: "Norwegian",
    nr: "South Ndebele",
    nv: "Navajo",
    ny: "Chichewa",
    oc: "Occitan",
    oj: "Ojibwa",
    om: "Oromo",
    or: "Oriya",
    os: "Ossetic",
    pa: "Panjabi",
    pi: "Pali",
    pl: "Polish",
    ps: "Pushto",
    pt: "Portuguese",
    qu: "Quechua",
    rm: "Romansh",
    rn: "Rundi",
    ro: "Romanian",
    ru: "Russian",
    rw: "Kinyarwanda",
    sa: "Sanskrit",
    sc: "Sardinian",
    sd: "Sindhi",
    se: "Northern Sami",
    sg: "Sango",
    si: "Sinhala",
    sk: "Slovak",
    sl: "Slovenian",
    sm: "Samoan",
    sn: "Shona",
    so: "Somali",
    sq: "Albanian",
    sr: "Serbian",
    ss: "Swati",
    st: "Sotho, Southern",
    su: "Sundanese",
    sv: "Swedish",
    sw: "Swahili",
    ta: "Tamil",
    te: "Telugu",
    tg: "Tajik",
    th: "Thai",
    ti: "Tigrinya",
    tk: "Turkmen",
    tl: "Tagalog",
    tn: "Tswana",
    to: "Tonga",
    tr: "Turkish",
    ts: "Tsonga",
    tt: "Tatar",
    tw: "Twi",
    ty: "Tahitian",
    ug: "Uighur",
    uk: "Ukrainian",
    ur: "Urdu",
    uz: "Uzbek",
    ve: "Venda",
    vi: "Vietnamese",
    vo: "Volapük",
    wa: "Walloon",
    wo: "Wolof",
    xh: "Xhosa",
    yi: "Yiddish",
    yo: "Yoruba",
    za: "Zhuang",
    zh: "Chinese",
    zu: "Zulu",
}

$.each(langs, function (key, value) {
    $(".js-select-language").append("<option value=" + key + ">" + value + "</option>")
})
//region end

$(".js-btn-not-you").on("click", async () => {
    disconnect().then((result) => {
        localStorage.removeItem("walletconnect")
        window.location.href = route("logout")
    })
})
