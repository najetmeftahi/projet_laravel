
$(document).ready((function(){var a=moment(new Date).add({days:0,months:0}).format("YYYY-MM-DD");function t(a,t){var e=moment(a,"YYYY-MM-DD"),n=moment(t,"YYYY-MM-DD");return moment.duration(n.diff(e)).asDays()}$("#plusday").click((function(){$("#duration").val(parseInt($("#duration").val())+1);var a=moment($("#edate").val(),"YYYY-MM-DD").add(1,"day").format("YYYY-MM-DD");$("#edate").val(a)})),$("#minusday").click((function(){$("#duration").val(parseInt($("#duration").val())-1);var a=moment($("#edate").val(),"YYYY-MM-DD").subtract(1,"day").format("YYYY-MM-DD");$("#edate").val(a)})),$("#sdate").change((function(){console.log($("#sdate").val()),$("#duration").val(t($("#sdate").val(),$("#edate").val()))})),$("#edate").change((function(){$("#duration").val(t($("#sdate").val(),$("#edate").val()))})),$("#sdate").val(a);var e=moment(new Date).add({days:0,months:2}).format("YYYY-MM-DD");$("#edate").val(e),$("#duration").val(t(a,e)),$("#duration").keyup((function(){var a=moment($("#sdate").val(),"YYYY-MM-DD").add($("#duration").val(),"days").format("YYYY-MM-DD");$("#edate").val(a)}))}));