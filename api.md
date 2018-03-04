# Api documentation
### Available methods

- [List outputs](#list-outputs)
- [Create output](#create-output)
- [Show output](#show-output)
- [Update output](#update-output)
- [Delete output](#delete-output)
- [Activate output](#activate-output)
- [Disable output](#disable-output)

List outputs
----
  Returns json data about all outputs

- **URL**

  /api/output

- **Method:**
  
  `GET`
  
- **URL Params**

    None

- **Data Params**

    None

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** 
    ```
    [
        {
            id: 12,
            name: "pump",
            pin: 1
        }
     ]
     ```
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output",
        dataType: "json",
        type : "GET",
        success : function(r) {
          console.log(r);
        }
      });
    ```
   
   
## Create output
----
  Create a new output with json data

- **URL**

  /api/output

- **Method:**
  
  `POST`
  
- **URL Params**

    None

- **Data Params**

    **Required:**
    
       `name=[string]`
       `pin=[integer 0-40]`

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** `{ 'success': 'true' }`
    
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`
    

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output",
        dataType: "json",
        type : "POST",
        data: { name: "pump", pin: 1 }
        success : function(r) {
          console.log(r);
        }
      });
    ```
    
    
 ## Show output
 ----
   Returns json data about a single output
 
 - **URL**
 
   /api/output/:id
 
 - **Method:**
   
   `GET`
   
 - **URL Params**
 
     `id=[integer]`
 
 - **Data Params**
 
    None
 
 * **Success Response:**
 
     * **Code:** 200 <br />
     **Content:** 
     ```
     {
         id: 12,
         name: "pump",
         pin: 1
     }
     ```
     
  
 * **Error Response:**
 
     * **Code:** 401 UNAUTHORIZED <br />
     **Content:** `{ error : "Log in" }`
     
 
 * **Sample Call:**
 
     ```
       $.ajax({
         url: "/api/output/1",
         dataType: "json",
         type : "GET",
         success : function(r) {
           console.log(r);
         }
       });
     ```
     
     
## Update output
----
  Update a single output with json data

- **URL**

  /api/output/:id

- **Method:**
  
  `PATCH` | `PUT`
  
- **URL Params**

    `id=[integer]`

- **Data Params**

    **Required:**
    
       `name=[string]`
       `pin=[integer 0-40]`

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** `{ 'success': 'true' }`
    
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`
    

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output/1",
        dataType: "json",
        type : "PUT",
        data: { name: "pump", pin: 1 }
        success : function(r) {
          console.log(r);
        }
      });
    ```
    
    
## Delete output
----
  Delete a single output

- **URL**

  /api/output/:id

- **Method:**
  
  `DELETE`
  
- **URL Params**

    `id=[integer]`

- **Data Params**

    None

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** `{ 'success': 'true' }`
    
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`
    

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output/1",
        dataType: "json",
        type : "DELETE",
        success : function(r) {
          console.log(r);
        }
      });
    ```
    
    
# Activate output
----
  Activate a single output

- **URL**

  /api/output/:id/activate

- **Method:**
  
  `GET`
  
- **URL Params**

    `id=[integer]`

- **Data Params**

    None

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** `{ 'success': 'true' }`
    
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`
    

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output/1/activate",
        dataType: "json",
        type : "GET",
        success : function(r) {
          console.log(r);
        }
      });
    ```
    
    
# Disable output
----
  Disable a single output

- **URL**

  /api/output/:id/disable

- **Method:**
  
  `GET`
  
- **URL Params**

    `id=[integer]`

- **Data Params**

    None

* **Success Response:**

    * **Code:** 200 <br />
    **Content:** `{ 'success': 'true' }`
    
 
* **Error Response:**

    * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`
    

* **Sample Call:**

    ```
      $.ajax({
        url: "/api/output/1/disable",
        dataType: "json",
        type : "GET",
        success : function(r) {
          console.log(r);
        }
      });
    ```