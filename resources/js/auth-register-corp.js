let currentPage = 0;
function pageManager() {
  $(".js-btn-prev").css("display", currentPage === 0 ? "none" : "");
  $(".js-btn-next").css("display", currentPage === $(".js-section-page").length - 1 ? "none" : "");
  $(".js-btn-submit").css("display", currentPage === $(".js-section-page").length - 1 ? "" : "none");
  checkFormFields();
  $(".js-section-page").each(function () {
    $(this).css("display", $(this).data("page") !== currentPage ? "none" : "");
  });
  $("step").each(function (e) {
    if ($(this).data("step") == currentPage) {
      $(this).removeClass();
      $(this).addClass("js-left-step");
      $(this).addClass("active");
    } else {
      if ($(this).data("step") < currentPage) {
        $(this).removeClass();
        $(this).addClass("js-left-step");
        $(this).addClass("done");
      }
      if ($(this).data("step") > currentPage) {
        $(this).removeClass();
        $(this).addClass("js-left-step");
        $(this).addClass("wait");
      }
    }
  });
  $(".js-section-page").trigger("input");
}
function fillCountries() {
  axios
    .get("https://api.countrystatecity.in/v1/countries", {
      headers: {
        "X-CSCAPI-KEY": "TFFvZ3ZISk1WQXJMRkE2OUthWk8xOG9jVXVQNll0QkE0d2VHWkZJWQ==",
      },
    })
    .then(function (response) {
      // handle success
      response.data.forEach((country) => {
        const option = $("<option>").val(country.iso2).text(country.name);
        $(".js-select-nationality-country").append(option);
      });
      response.data.forEach((country) => {
        const option = $("<option>").val(country.iso2).text(country.name);
        $(".js-select-nationality-country_secondary").append(option);
      });
    });
}
// Initialization
pageManager();
fillYearOptions();
fillMonthOptions();
fillCountries();
updateDays();
//#endregion
//#region page 0
const walletAddress = new URLSearchParams(window.location.search).get("wallet_address");
$(".js-input-wallet-address").val(walletAddress);
function fillYearOptions() {
  const currentYear = new Date().getFullYear();
  for (let i = currentYear; i >= currentYear - 100; i--) {
    const option = $("<option>").val(i).text(i);
    $(".js-select-year").append(option);
  }
}
function fillMonthOptions() {
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  monthNames.forEach((month, index) => {
    const option = $("<option>")
      .val(index + 1)
      .text(month);
    $(".js-select-month").append(option);
  });
}
function updateDays() {
  const selectedYear = parseInt($(".js-select-year").val());
  const selectedMonth = parseInt($(".js-select-month").val());
  const daysInMonth = new Date(selectedYear, selectedMonth, 0).getDate();
  $(".js-select-day").html("");
  for (let i = 1; i <= daysInMonth; i++) {
    const option = $("<option>").val(i).text(i);
    $(".js-select-day").append(option);
  }
}
function updateRealDate() {
  const year = $(".js-select-year").val();
  const month = $(".js-select-month").val();
  const day = $(".js-select-day").val();
  const realDate = new Date(year, month - 1, day);
  const formattedDate = realDate.toISOString().slice(0, 10);
  $(".js-real-establishment").val(formattedDate);
}
function fillStatesBaseOnCountry(country) {
  axios
    .get(`https://api.countrystatecity.in/v1/countries/${country}/states`, {
      headers: {
        "X-CSCAPI-KEY": "TFFvZ3ZISk1WQXJMRkE2OUthWk8xOG9jVXVQNll0QkE0d2VHWkZJWQ==",
      },
    })
    .then(function (response) {
      $(".js-select-nationality-state").html("");
      if (response.data.length === 0) {
        $(".js-select-nationality-state").html(`<option value="NO">No State</option>`);
      }
      response.data.forEach((state) => {
        const option = $("<option>").val(state.iso2).text(state.name);
        $(".js-select-nationality-state").append(option);
      });
      response.data.forEach((state) => {
        const option = $("<option>").val(state.iso2).text(state.name);
        $(".js-select-nationality-state").append(option);
      });
    })
    .catch(function (e) {
      console.log(e);
    });
}

$(".js-select-year").on("change", () => {
  updateDays();
  updateRealDate();
});
$(".js-select-month").on("change", () => {
  updateDays();
  updateRealDate();
});
$(".js-btn-next").on("click", () => {
  currentPage++;
  pageManager();
});
$(".js-btn-prev").on("click", () => {
  currentPage--;
  pageManager();
});
$(".js-select-day").on("change", updateRealDate);
$(".js-select-nationality-country").on("change", function () {
  const country = $(this).val();
  fillStatesBaseOnCountry(country);
});
// js-section-nationality-secondray
$(".js-btn-add-nationality").on("click", function () {
  $(this).css("display", "none");
  $(".js-section-nationality-secondray").css("display", "grid");
});
$(".js-btn-remove-nationality").on("click", function () {
  $(".js-btn-add-nationality").css("display", "block");
  $(".js-section-nationality-secondray").css("display", "none");
});
const categories = [
  { value: "medical", text: "Medical" },
  { value: "educational", text: "Educational" },
  { value: "financial", text: "Financial" },
  { value: "services", text: "Services" },
  { value: "travel", text: "Travel" },
];
categories.forEach((category) => {
  const option = $("<option>", {
    value: category.value,
    text: category.text,
  });
  $(".js-corp-cat-pri").append(option);
});
// subcategory
const subcategories = {
  medical: ["Pharmaceuticals", "Medical Devices", "Healthcare Services"],
  educational: ["K-12 Education", "Higher Education", "Online Learning"],
  financial: ["Banking", "Investment Management", "Insurance"],
  services: ["Consulting", "Marketing", "Technology Services"],
  travel: ["Air Travel", "Hotels", "Car Rentals"],
};
$(".js-corp-cat-pri").on("change", function () {
  const selectedCategory = $(this).val();
  const subcategoryOptions = subcategories[selectedCategory];
  $(".js-corp-cat-sec").html("");
  subcategoryOptions.forEach((subcategory) => {
    const option = $("<option>").val(subcategory).text(subcategory);
    $(".js-corp-cat-sec").append(option);
  });
});
//#endregion
//#region page 1
$(".js-corp-tab-change").on("click", function () {
  let activeTab = $(this).attr("data-active-tab");
  $(".js-corp_form_real").val(activeTab);
  $(".js-corp-tab-circle").toggleClass("float-left float-right");

  if (activeTab == "classic") {
    $(".js-dao-link").val("0");
    checkFormFields();
  }
  if (activeTab == "dao") {
    $(".js-dao-link").val("");
    checkFormFields();
  }

  $(".js-corp-tab").each(function () {
    $(this).hide();
  });
  $('tab[data-tab="' + activeTab + '"]').show();
  if (activeTab === "classic") {
    $(this).attr("data-active-tab", "dao");
  } else {
    $(this).attr("data-active-tab", "classic");
  }
});
//#endregion
//#region page 2
function manageSections(action, sectionClass, buttonClass, buttonRemoveClass) {
  $("body").on("click", buttonClass, function () {
    if (action === "add") {
      let section = $(sectionClass).last().clone();
      section.attr("data-section", parseInt(section.attr("data-section")) + 1);
      section.find("[data-section]").attr("data-section", function () {
        return parseInt($(this).attr("data-section")) + 1;
      });
      $(sectionClass).last().after(section);
      $(buttonClass + ":not(:last)").hide();
      $(buttonRemoveClass + ":not(:last)").show();
    } else if (action === "remove") {
      $(this).closest(sectionClass).remove();
    }
  });
}
manageSections("add", ".js-section-profession", ".js-btn-profession", ".js-btn-profession-remove");
manageSections("remove", ".js-section-profession", ".js-btn-profession-remove");
manageSections("add", ".js-section-skill", ".js-btn-skill", ".js-btn-skill-remove");
manageSections("remove", ".js-section-skill", ".js-btn-skill-remove");
manageSections("add", ".js-section-language", ".js-btn-language", ".js-btn-language-remove");
manageSections("remove", ".js-section-language", ".js-btn-language-remove");
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
};
$.each(langs, function (key, value) {
  $(".js-select-language").append("<option value=" + key + ">" + value + "</option>");
});
//region end

//form validation begin
function validateEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function updateFieldValidationStatus(isValid, fieldElement) {
  if (isValid) {
    fieldElement.removeClass("bg-[#ff000030] placeholder:text-red-500");
  } else {
    fieldElement.addClass("bg-[#ff000030] placeholder:text-red-500");
  }
}

function checkFormFields() {
  let formFieldsValid = true;
  let fieldQl = $("html").find('input[data-formula="e=mc^2"]');
  fieldQl.remove();

  $(".js-section-page")
    .eq(currentPage)
    .find('input:not([type="file"]):not([type="hidden"]), select')
    .each(function () {
      const fieldValue = $(this).val();
      const fieldName = $(this).attr("name");
      const fieldMax = parseInt($(this).attr("maxlength")) || null;
      let fieldValid = true;

      // Add a flag to each field to track if the user has interacted with it
      if (typeof $(this).data("interacted") === "undefined") {
        $(this).data("interacted", false);
      }

      // Check if the field is empty
      if (fieldValue === "") {
        fieldValid = false;
      }

      // Check if the field is empty
      if (fieldValue === "") {
        // For optional fields, set fieldValid to true when empty
        if (["website", "youtube", "facebook", "twitter", "instagram", "linkedin", "telegram"].includes(fieldName)) {
          fieldValid = true;
        } else {
          fieldValid = false;
        }
      }
      // Check if the URL fields are valid
      if (
        ["website", "youtube", "facebook", "twitter", "instagram", "linkedin", "telegram"].includes(fieldName) &&
        fieldValue !== "" &&
        !fieldValue.match(/((?:https?:\/\/)?(?:www\.)?[a-ž0-9\.-]+\.[a-ž]{2,4}\/?.*)/)
      ) {
        fieldValid = false;
      }

      // Check if the string fields have a valid length
      if (fieldMax && fieldValue.length > fieldMax) {
        fieldValid = false;
      }

      // Only update the field's validation status if the user has interacted with it
      if ($(this).data("interacted")) {
        updateFieldValidationStatus(fieldValid, $(this));
      }

      if (!fieldValid) {
        formFieldsValid = false;
      }
    });

  // Enable/Disable the next button based on form fields status
  if (formFieldsValid) {
    $(".js-btn-next").removeClass("cursor-not-allowed opacity-50");
    $(".js-btn-next").prop("disabled", false);
  } else {
    $(".js-btn-next").addClass("cursor-not-allowed opacity-50");
    $(".js-btn-next").prop("disabled", true);
  }
}

// Call checkFormFields function on input/select changes
$(".js-section-page").on("input change", "input, select", function () {
  // Set the interaction flag to true upon user input
  $(this).data("interacted", true);
  checkFormFields();
});

$(".js-section-page").on("change", "select", function () {
  // Set the interaction flag to true upon user input
  $(this).data("interacted", true);
  checkFormFields();
});

//form validation end

// upload
import * as FilePond from "filepond";
// Get a reference to the file input element


// Import the plugin code
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginPdfPreview from "filepond-plugin-pdf-preview";
// Import the plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

// Register the plugin
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginPdfPreview);
const inputElement = document.querySelector('input[type="file"]');

// Create a FilePond instance
const pond = FilePond.create(inputElement, {
  server: {
    url: "/api/filepond", // Update this to your Laravel API endpoint
    process: "/process",
    revert: "/revert",
    restore: "/restore",
    load: "/load",
  },
});

// Listen for the 'processfile' event and log the file path
pond.on("processfile", (error, file) => {
  if (error) {
    console.error("File processing failed:", error);
    return;
  }
  const response = JSON.parse(file.serverId);
  $(".js-corp-file").val(response.id);
});



$(".js-btn-not-you").on("click", async () => {
  disconnect().then((result) => {
      localStorage.removeItem("walletconnect")
      window.location.href = route("logout")
  })
})