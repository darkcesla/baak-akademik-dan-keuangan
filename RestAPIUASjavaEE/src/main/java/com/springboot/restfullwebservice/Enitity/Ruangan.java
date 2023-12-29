package com.springboot.restfullwebservice.Enitity;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "ruangan")
public class Ruangan {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nama_ruangan ;
    private String status_ruangan;
    private String kapasitas;
    
    public Ruangan() {}
    
	public Ruangan(Long id, String nama_ruangan, String status_ruangan,String kapasitas) {
		super();
		this.id = id;
		this.nama_ruangan = nama_ruangan;
		this.status_ruangan = status_ruangan;
		this.kapasitas = kapasitas;
	}

	
	public String getKapasitas() {
		return kapasitas;
	}

	public void setKapasitas(String kapasitas) {
		this.kapasitas = kapasitas;
	}

	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public String getNama_ruangan() {
		return nama_ruangan;
	}
	public void setNama_ruangan(String nama_ruangan) {
		this.nama_ruangan = nama_ruangan;
	}
	public String getStatus_ruangan() {
		return status_ruangan;
	}
	public void setStatus_ruangan(String status_ruangan) {
		this.status_ruangan = status_ruangan;
	}
    
    

}