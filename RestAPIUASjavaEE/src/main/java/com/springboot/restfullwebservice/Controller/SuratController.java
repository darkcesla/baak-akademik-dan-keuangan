package com.springboot.restfullwebservice.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.SuratService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("api/surat")
public class SuratController {

    private final SuratService suratService;
    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;

    @Autowired
    public SuratController(SuratService suratService) {
        this.suratService = suratService;
    }

    @PostMapping("/create")
    public ResponseEntity<?> createSurat(@RequestBody Surat surat,@RequestHeader("Authorization") String token) {
        User user;
        if (token == null || !token.startsWith("Bearer ")) {
       	 Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
       }
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            surat.setUser(user);
        	Surat createdSurat = suratService.createSurat(surat);
            return new ResponseEntity<>(createdSurat, HttpStatus.CREATED);
             
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }

    @GetMapping("/all")
    public ResponseEntity<?> getAllBookingRuangan(@RequestHeader("Authorization") String token) {
        List<Surat> surat = suratService.getAllSurat();
        User user;
        if (token == null || !token.startsWith("Bearer ")) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            LoginResponse response = new LoginResponse(user);
            if (user.getRoles().toString().equals("Admin")) {
            return new ResponseEntity<>(surat, HttpStatus.OK);
            }
            else {
            	 Map<String, String> error = new HashMap<>();
                 error.put("error", "Your Not Admin");
                 return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
            }
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }
    
    @GetMapping("/alls")
    public ResponseEntity<?> getAllBookingRuanganUser(@RequestHeader("Authorization") String token) {
        User user;
        if (token == null || !token.startsWith("Bearer ")) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            LoginResponse response = new LoginResponse(user);
            
            List<Surat> surat = suratService.getSuratByUser(user.getId());

            return new ResponseEntity<>(surat, HttpStatus.OK);
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }


    @GetMapping("get/{id}")
    public ResponseEntity<Surat> getSuratById(@PathVariable Long id) {
        Surat surat = suratService.getSuratById(id);
        if (surat != null) {
            return new ResponseEntity<>(surat, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<Surat> updateSurat(@PathVariable Long id, @RequestBody Surat updatedSurat) {
        Surat updated = suratService.updateSurat(id, updatedSurat);
        if (updated != null) {
            return new ResponseEntity<>(updated, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/status/{id}")
    public ResponseEntity<?> changeSuratStatus(@RequestHeader("Authorization") String token,@PathVariable Long id,  @RequestBody Surat updatedSurat) {
        Surat updatedStatus = suratService.changeStatus(id, updatedSurat);
        User user;
        if (token == null || !token.startsWith("Bearer ")) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            LoginResponse response = new LoginResponse(user);
            if (user.getRoles().toString().equals("Admin") && updatedStatus != null ) {
                   return new ResponseEntity<>(updatedStatus, HttpStatus.OK);
            }
              else if(updatedStatus == null) {
                    return new ResponseEntity<>(HttpStatus.NOT_FOUND);
                }
              	else {
            	  	Map<String, String> error = new HashMap<>();
            	  	error.put("error", "Your Not Admin");
                    return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
            }
        } 
        catch (Exception e) {
        	Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }
    

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> deleteSuratById(@PathVariable Long id) {
        suratService.deleteSuratById(id);
        return new ResponseEntity<>("Surat dengan ID " + id + " berhasil dihapus.", HttpStatus.OK);
    }
}
