package com.springboot.restfullwebservice.Enitity;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "users")
public class User {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String username;
    private String password;
    private String roles;
    private String Nomor_KTP;
    private String NIM;
    private String Nama_Lengkap;
    private String Nomor_Handphone;
    private String token;
    
    
    public User() {}
	public User(Long id, String username, String password, String nomor_KTP, String nIM,
			String nama_Lengkap, String nomor_Handphone,String token) {
		super();
		this.id = id;
		this.username = username;
		this.password = password;
		Nomor_KTP = nomor_KTP;
		NIM = nIM;
		Nama_Lengkap = nama_Lengkap;
		Nomor_Handphone = nomor_Handphone;
		this.token = token;
	}
	


	public String getToken() {
		return token;
	}

	public void setToken(String token) {
		this.token = token;
	}

	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getRoles() {
		return roles;
	}
	public void setRoles(String roles) {
		this.roles = roles;
	}
	public String getNomor_KTP() {
		return Nomor_KTP;
	}
	public void setNomor_KTP(String nomor_KTP) {
		Nomor_KTP = nomor_KTP;
	}
	public String getNIM() {
		return NIM;
	}
	public void setNIM(String nIM) {
		NIM = nIM;
	}
	public String getNama_Lengkap() {
		return Nama_Lengkap;
	}
	public void setNama_Lengkap(String nama_Lengkap) {
		Nama_Lengkap = nama_Lengkap;
	}
	public String getNomor_Handphone() {
		return Nomor_Handphone;
	}
	public void setNomor_Handphone(String nomor_Handphone) {
		Nomor_Handphone = nomor_Handphone;
	}
    
    // constructors, getters, and setters
    
    // ...
}
