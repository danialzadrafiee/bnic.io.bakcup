   <dialog id="addCategotyModal" class="modal">
       <form method="dialog" class="modal-box">
           <!-- Modal header -->
           <header class="flex items-start  justify-between p-4 border-b rounded-t ">
               <h3 class="text-xl font-semibold ">
                   Create Cateogry
               </h3>
               <button for="addCategotyModal" class="btn btn-sm btn-square btn-ghost absolute right-2 top-2">✕</button>
           </header>
           <!-- Modal body -->
           <modal-body class="flex flex-col p-6 gap-4">
               <category-name>
                   <field>
                       <label class="block text-black/70 text-sm font-semibold mb-2">
                           Category title
                       </label>
                       <input type="text" maxlength="80" autofocus class=" js-category-name shadow appearance-none border rounded w-full py-2 px-3 text-black/70 leading-tight focus:outline-none focus:shadow-outline mb-2"
                           placeholder="Ex: Workshops">
                   </field>
               </category-name>
               <iconPicker class="icon-picker  mb-6">
                   <label class="grid grid-cols-7 items-center ">
                       <label class="block text-black/70 col-span-2 text-sm font-semibold mb-2" for="icon">
                           Pick an Icon
                       </label>
                       {{-- <input type="text" id="search" placeholder="Search for an icon..." class="col-span-5 shadow appearance-none border rounded w-full py-2 px-3 text-black/70 leading-tight focus:outline-none focus:shadow-outline mb-2"> --}}
                   </label>
                   
                   <div id="icon-list" class="icon-list grid w-full grid-cols-10 gap-2 mt-2">
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-users"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-chart-bar"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-tachometer-alt"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-clipboard-list"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-alt"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-briefcase"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-calendar-alt"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-comments"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-building"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-money-bill-alt"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-sitemap"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-project-diagram"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-tasks"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-dollar-sign"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-thumbs-up"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-clock"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-credit-card"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-desktop"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-inbox"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-globe"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-laptop"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-bell"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-server"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-lock"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-user-shield"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-user-secret"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-tools"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-envelope-open"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-database"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-phone"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-user-tie"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-paperclip"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-business-time"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-archive"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-download"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-export"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-import"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-invoice-dollar"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-powerpoint"></i>
                       </div>
                       <div class="flex items-center justify-center border border-neutral-5/30 w-8 h-8 hover:bg-primary hover:text-white cursor-pointer rounded-lg js_category_icon">
                           <i class="fas fa-file-upload"></i>
                       </div>
                   </div>
               </iconPicker>
               <publicity>
                   <label class="relative inline-flex items-center cursor-pointer">
                       <input type="checkbox" name="publicity" class="toggle toggle-primary js-category-publicity">
                       <span class="ml-3 text-sm font-medium ">Privite</span>
                   </label>
               </publicity>
           </modal-body>
           <!-- Modal footer -->
           <footer class="flex items-center p-6 space-x-2 border-t border-black/20 rounded-b ">
               <button disabled="true" type="button" class="btn btn-md js-category-submit btn-primary">I
                   accept</button>
               <button for="addCategotyModal" class="btn  ">Decline</button>
           </footer>
       </form>
       <form method="dialog" class="modal-backdrop">
           <button>close</button>
       </form>
   </dialog>
