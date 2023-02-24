export const ajax = {

     GET(url){
        return $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                return response;
            }
        });
    },
    
    POST(url, data){
        return $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                return response;
            }
        });
    }
}