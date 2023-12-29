package com.springboot.restfullwebservice.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.Kaos;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.KaosService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Optional;

@RestController
@RequestMapping("/api/kaos")
public class KaosController {

    private final KaosService kaosService;
    
    @Autowired
    private UserService userService;
    @Autowired
    private JwtUtil jwtUtil;
    

    @Autowired
    public KaosController(KaosService kaosService) {
        this.kaosService = kaosService;
    }

    @GetMapping("/all")
    public ResponseEntity<List<Kaos>> getAllKaos(@RequestHeader("Authorization") String token) {
        List<Kaos> kaosList = kaosService.getAllKaos();
        return new ResponseEntity<>(kaosList, HttpStatus.OK);
    }
    
    @GetMapping("/get/{id}")
    public ResponseEntity<?> getKaosById(@PathVariable Long id, @RequestHeader("Authorization") String token) {
        if (token == null || !token.startsWith("Bearer ")) {
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            User user = userService.findUserByUsername(username);
            
            Kaos kaos = kaosService.getKaosById(id);
            if (kaos != null) {
                return ResponseEntity.ok(kaos);
            } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }

    @PostMapping("/add")
    public ResponseEntity<?> createKaos(@RequestBody Kaos kaos,@RequestHeader("Authorization") String token) {
    	User user;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            if (user.getRoles().toString().equals("Admin")) {
            	 Kaos createdKaos = kaosService.createKaos(kaos);
                 return new ResponseEntity<>(createdKaos, HttpStatus.CREATED);
            }
            else {
            	Map<String, String> error = new HashMap<>();
                error.put("error", "Your Not Admin");
                return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);           
                }
       
    }

    @PutMapping("edit/{id}")
    public ResponseEntity<?> updateKaos(@PathVariable Long id, @RequestBody Kaos updatedKaos,
    		@RequestHeader("Authorization") String token) {
    	
    	User user;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            if (user.getRoles().toString().equals("Admin")) {
           	 	Kaos kaos = kaosService.updateKaos(id, updatedKaos);
                 if (kaos != null) {
                     return new ResponseEntity<>(kaos, HttpStatus.OK);
                 }
            }
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Not Admin");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);       
                  
    }

    @DeleteMapping("delete/{id}")
    public ResponseEntity<?> deleteKaos(@PathVariable Long id,@RequestHeader("Authorization") String token) {
    	User user;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            if (user.getRoles().toString().equals("Admin")) {
            	 boolean deleted = kaosService.deleteKaos(id);
                 if (deleted) {
                	 Map<String, String> success = new HashMap<>();
                	 success.put("success", "Berhasil Menghapus Kaos");
                     return ResponseEntity.status(HttpStatus.OK).body(success);
                 }
            }
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Not Admin");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);           
    }
}
