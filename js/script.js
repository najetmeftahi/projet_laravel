


function logout(){window.location.href="logout.php"}function showdash(){$("#panel-dashboard").show(),$("#panel-projects").hide(),$("#panel-settings").hide(),$("#AddPjPanel").hide(),$("#btndash").addClass("isactive"),$("#btnpj").removeClass("isactive"),$("#btnset").removeClass("isactive"),$("#BacklogArea").hide(),$("#panel-workon").hide(),"0"==$(".totalpjs").html()?$("#init").show():$("#init").hide()}function showprojects(){$("#panel-dashboard").hide(),$("#panel-settings").hide(),$("#panel-projects").show(),$("#AddPjPanel").hide(),$("#btndash").removeClass("isactive"),$("#btnset").removeClass("isactive"),$("#btnpj").addClass("isactive"),$("#BacklogArea").hide(),$("#panel-workon").hide(),lsprojects()}function showsettings(){$("#panel-settings").show(),$("#panel-dashboard").hide(),$("#panel-projects").hide(),$("#AddPjPanel").hide(),$("#btndash").removeClass("isactive"),$("#btnpj").removeClass("isactive"),$("#btnset").addClass("isactive"),$("#BacklogArea").hide(),$("#panel-workon").hide()}function loadusers(){$("#userstablebody").html(""),usertablebod="",adduserrow='\n    <tr>\n        <td colspan="3">\n            <button class="btn btn-sm btn-outline-secondary border-0 fw-light" id="addnewuser">+ Add New User</button>\n        </td>\n    </tr>\n  ';var e=$.ajax({type:"POST",url:"./API/settings.php",data:{loadusers:"all"},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText;$.each(JSON.parse(e),(function(e,t){"0"==t.isroot?(delbtn=`\n            <span class="btn btn-sm btn-outline-danger border-0" id="CallToDeleteUser" for="${t.id}">\n                <i class="fa-solid fa-trash"></i>\n            </span>`,editable="iseditable"):(delbtn='\n            <span class="text-muted" disabled>\n                <i class="fa-solid fa-trash"></i>\n            </span>',editable="isNoteditable"),row=`\n        <tr>\n        <td class="${editable}" for="user" uid="${t.id}">${t.user}</td>\n        <td class="iseditable" for="pass" uid="${t.id}">${t.pass}</td>\n        <td>${delbtn}</td>\n        </tr>\n        `,usertablebod+=row})),usertablebod+=adduserrow,$("#userstablebody").html(usertablebod)}function Updateuser(e,t,a){$.ajax({type:"POST",url:"./API/settings.php",data:{updateuser:e,for:t,newval:a},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText}function getdbdetails(){var e=$.ajax({type:"POST",url:"./API/updateconfig.php",data:{dbdetails:"db"},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText;e=JSON.parse(e),$(".dbs").html(e.server),$(".dbu").html(e.user),$(".dbp").html(e.pass),$(".dbn").html(e.name)}function getdbstatus(){"1"!==$.ajax({type:"POST",url:"./API/updateconfig.php",data:{dbstatus:"db"},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText?$(".dbstatuscell").html('<span class="dbstatus text-danger"><i class="fa-solid fa-circle-exclamation"></i> Not Connected</span>'):$(".dbstatuscell").html('<span class="dbstatus text-success"><i class="fa-solid fa-circle-check"></i> Connected</span>')}function loadbackups(){$("#backupstable").html("");var e=$.ajax({type:"POST",url:"./API/settings.php",data:{listbackups:"all"},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText;$.each(JSON.parse(e),(function(e,t){$("#backupstable").prepend(`\n            <tr>\n                <td colspan="2"><a href="API/backups/${t}">${t}</a></td>\n            </tr>\n         `)}))}function getCalDetails(){$("#wdaysDiv").html(""),$(".hpd").val(1),$("#holidaystablebody").html(""),week=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];var e=$.ajax({type:"POST",url:"./API/updateconfig.php",data:{calendardetails:"all"},dataType:"json",context:document.body,global:!1,async:!1,success:function(e){return e}}).responseText;workingWeekDays=JSON.parse(e).workingdays,wdays="",hdays="",AllWeekDays="",$.each(week,(function(e,t){dayinweek=e+1,ischecked="",workingWeekDays.includes(dayinweek)&&(ischecked="checked"),wdays+=`\n            <div class="form-check">\n                <input class="weekdaycheck form-check-input" type="checkbox" value="${dayinweek}" id="d_${dayinweek}" ${ischecked}>\n                <label class="form-check-label" for="d_${dayinweek}">\n                    ${t}\n                </label>\n            </div>\n        \n        `})),$.each(JSON.parse(e).holidays,(function(e,t){hdays+=`\n                <tr>\n                <td>${t}</td>\n                <td>\n                <span class="btn btn-sm btn-outline-danger border-0" id="DeleteHoliday" for="${t}"><i class="fa-solid fa-circle-minus"></i></span>\n                </td>\n                </tr>\n        `})),$("#wdaysDiv").html(wdays),$(".hpd").val(parseInt(JSON.parse(e).hpd)),$("#holidaystablebody").html(hdays)}$("#loginbtn").click((function(e){e.preventDefault();var t=$("#userid").val().replace(/[^a-z0-9]/gi,""),a=$("#userpass").val().replace(/[^a-z0-9]/gi,"");""!==t&&""!==a?$.ajax({type:"POST",url:".",data:{id:t,pass:a,token:"dGVtcG9fdG9rZW4="},dataType:"text",success:function(e){location.reload()}}):alert("Empty fields !")})),SettingsTabClasses=["SetTab1","SetTab2","SetTab3","SetTab4"],$(".tabsMenuToggle").click((function(){SelectedClass=$(this).attr("for"),$.each(SettingsTabClasses,(function(e,t){t!==SelectedClass&&$(`.${t}`).hide()})),$(`.${SelectedClass}`).show(),$(this).parent().children().removeClass("text-light"),$(this).parent().children().removeClass("bg-secondary"),$(this).addClass("text-light"),$(this).addClass("bg-secondary"),"SetTab4"==$(this).attr("for")&&loadusers(),"SetTab3"==$(this).attr("for")&&(getdbstatus(),getdbdetails(),loadbackups()),"SetTab2"==$(this).attr("for")&&getCalDetails()})),$("#userstable").on("click","#addnewuser",(function(){$.ajax({type:"POST",url:"./API/settings.php",data:{adduser:"new"},dataType:"json",success:function(e){}}),setTimeout((()=>{loadusers()}),50)})),$("#userstable").on("click","#CallToDeleteUser",(function(){$.ajax({type:"POST",url:"./API/settings.php",data:{deleteuser:$(this).attr("for")},dataType:"json",success:function(e){}}),setTimeout((()=>{loadusers()}),50)})),$("#userstable").on("click",".iseditable",(function(){$(this).attr("contenteditable","plaintext-only"),$(this).addClass("noborder"),$(this).focus()})),$("#userstable").on("blur",".iseditable",(function(){Updateuser($(this).attr("uid"),$(this).attr("for"),$(this).text()),setTimeout((()=>{loadusers()}),50)})),$("#Backupdb").click((function(){$.post("./API/sqldump.php",{backup:"db"},(function(e){loadbackups()}))})),$(".hpd").keyup((function(e){$(this).val()>24||$(this).val()<1?getCalDetails():$.post("./API/updateconfig.php",{updatehpd:$(this).val()},(function(e){getCalDetails()}))})),$("#wdaysDiv").on("change",".weekdaycheck",(function(){$(this).is(":checked")?$.post("./API/updateconfig.php",{updateDay:$(this).val(),action:"add"},(function(e){})):$.post("./API/updateconfig.php",{updateDay:$(this).val(),action:"remove"},(function(e){})),setTimeout((()=>{getCalDetails()}),50)})),$("#addholiday").click((function(e){$.post("./API/updateconfig.php",{updateholidays:$("#SelectedholidayDate").val(),action:"add"},(function(e){getCalDetails()}))})),$("#holidaystablebody").on("click","#DeleteHoliday",(function(){$.post("./API/updateconfig.php",{updateholidays:$(this).attr("for"),action:"remove"},(function(e){getCalDetails()}))})),showdash();