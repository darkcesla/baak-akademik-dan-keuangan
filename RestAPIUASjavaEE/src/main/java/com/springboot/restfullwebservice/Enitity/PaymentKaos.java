package com.springboot.restfullwebservice.Enitity;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;


@Entity
@Table(name = "payment_kaos")
public class PaymentKaos {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	@ManyToOne
	@JoinColumn(name = "id_kaos")
    private Kaos kaos;
	@Column(name = "jenis_pembayaran")	 
    private String jenis_pembayaran;
 	@Column(name = "nominal_pembayaran")
    private Long nominal_pembayaran;
    @ManyToOne
   	@JoinColumn(name = "id_users")
    private User user;
    

    public PaymentKaos() {}

    public PaymentKaos(Long id,Kaos kaos, String jenis_pembayaran, Long nominal_pembayaran,User user) {
        this.id = id;
    	this.kaos = kaos;
        this.jenis_pembayaran = jenis_pembayaran;
        this.nominal_pembayaran = nominal_pembayaran;
        this.user = user;
    }
    // getter setter

    

	public User getuser() {
		return user;
	}

	public void setuser(User user) {
		this.user = user;
	}

	public void setNominal_pembayaran(Long nominal_pembayaran) {
		this.nominal_pembayaran = nominal_pembayaran;
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public Kaos getKaos() {
		return kaos;
	}

	public void setKaos(Kaos kaos) {
		this.kaos = kaos;
	}

	public String getJenis_pembayaran() {
		return jenis_pembayaran;
	}

	public void setJenis_pembayaran(String jenis_pembayaran) {
		this.jenis_pembayaran = jenis_pembayaran;
	}

	public long getNominal_pembayaran() {
		return nominal_pembayaran;
	}

	public void setNominal_pembayaran(long nominal_pembayaran) {
		this.nominal_pembayaran = nominal_pembayaran;
	}
    
    
  
}
