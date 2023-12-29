package com.springboot.restfullwebservice.Enitity;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Kaos {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    
    private String ukuran;
    private Long harga;
    private String keterangan;

    // Constructors, Getters, and Setters

    public Kaos() {
        // Default constructor
    }

    public Kaos(String ukuran, Long harga, String keterangan) {
        this.ukuran = ukuran;
        this.harga = harga;
        this.keterangan = keterangan;
    }
    // Getters and Setters

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getUkuran() {
		return ukuran;
	}

	public void setUkuran(String ukuran) {
		this.ukuran = ukuran;
	}

	public Long getHarga() {
		return harga;
	}

	public void setHarga(Long harga) {
		this.harga = harga;
	}

	public String getKeterangan() {
		return keterangan;
	}

	public void setKeterangan(String keterangan) {
		this.keterangan = keterangan;
	}

    
}
