$("modal").on("click", function (event) {
  if (event.target.tagName == "MODAL") {
    $(this).css("display", "none");
  }
});

$(".js-btn-categories").on("click", function () {
  $(".js-modal-categories").css("display", "flex");
});
$(".js-btn-categories-close").on("click", function () {
  $(".js-modal-categories").css("display", "none");
});

$(".js-btn-search").on("click", function () {
  let query = $(".js-input-search").val();

  axios
    .get(route("actions.search_corp_by_name"), {
      params: {
        query: query,
      },
    })
    .then(function (response) {
      let corporations = response.data;
      $(".js-section-corp-data").empty();
      corporations.forEach(function (corporation) {
        let cvHtml = corporation.corp_cv.replace(/<\/?[^>]+(>|$)/g, "");
        cvHtml = cvHtml.length > 90 ? cvHtml.substring(0, 90) + ".." : cvHtml;
        let template = `<corporation>
                <inside>
                   <column>
                       <img
                           src="https://api.dicebear.com/6.x/initials/svg?seed=${corporation.corp_name.replace(/[^a-zA-Z0-9]/g, "")}" />
                   </column>
                   <column>
                       <top>
                           <name>
                              ${corporation.corp_name}
                           </name>
                           <links>
                               <a href="${route("document.show", { id: corporation.id })}"> Documents</a>
                           </links>
                       </top>
                       <bottom>
                           <describe>
                               <detail>
                                   ${cvHtml}
                               </detail>
                           </describe>
                           <group>
                               <tag>
                                   <label>Type</label>
                                   <span> ${corporation.corp_cat_pri}</span>
                               </tag>
                               <tag>
                                   <label>Type</label>
                                   <span> ${corporation.corp_cat_sec}</span>
                               </tag>
                           </group>
                       </bottom>
                   </column>
               </inside>
            </corporation>`;
        $(".js-section-corp-data").append(template);
      });
    })
    .catch(function (error) {
      console.log(error);
    });
});

