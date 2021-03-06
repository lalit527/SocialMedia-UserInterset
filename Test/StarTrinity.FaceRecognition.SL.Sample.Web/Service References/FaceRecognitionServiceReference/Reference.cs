﻿//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//     Runtime Version:4.0.30319.225
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference {
    
    
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    [System.ServiceModel.ServiceContractAttribute(ConfigurationName="FaceRecognitionServiceReference.FaceRecognitionServiceSoap")]
    public interface FaceRecognitionServiceSoap {
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/VerifyAppIdAndGetToken", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        string VerifyAppIdAndGetToken(string appId, string password);
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/SubmitFaceForTraining", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(StructuralObject))]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(EntityKeyMember[]))]
        [return: System.ServiceModel.MessageParameterAttribute(Name="percentage")]
        double SubmitFaceForTraining(out string errorMessage, out bool isReadyForLogin, out string messageForUser, string token, StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FacesForTraining face);
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/GetLoginData", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(StructuralObject))]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(EntityKeyMember[]))]
        [return: System.ServiceModel.MessageParameterAttribute(Name="faceClassifiersXml")]
        string GetLoginData(out bool requiresServerSideRecognition, string token, string email);
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/DeleteLoginData", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(StructuralObject))]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(EntityKeyMember[]))]
        void DeleteLoginData(string token, string email);
        
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/GetLoggedInUser", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(StructuralObject))]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(EntityKeyMember[]))]
        string GetLoggedInUser(string token);
        
        // CODEGEN: Parameter 'jpegData' requires additional schema information that cannot be captured using the parameter mode. The specific attribute is 'System.Xml.Serialization.XmlElementAttribute'.
        [System.ServiceModel.OperationContractAttribute(Action="http://tempuri.org/Recognize", ReplyAction="*")]
        [System.ServiceModel.XmlSerializerFormatAttribute(SupportFaults=true)]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(StructuralObject))]
        [System.ServiceModel.ServiceKnownTypeAttribute(typeof(EntityKeyMember[]))]
        [return: System.ServiceModel.MessageParameterAttribute(Name="confidence")]
        StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeResponse Recognize(StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeRequest request);
    }
    
    /// <remarks/>
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.Xml", "4.0.30319.225")]
    [System.SerializableAttribute()]
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.ComponentModel.DesignerCategoryAttribute("code")]
    [System.Xml.Serialization.XmlTypeAttribute(Namespace="http://tempuri.org/")]
    public partial class FacesForTraining : EntityObject {
        
        private System.Guid idField;
        
        private System.Guid sessionIdField;
        
        private string emailField;
        
        private byte[] faceField;
        
        private int faceWidthField;
        
        private byte[] snapshotJpegField;
        
        private string clientIpAddressField;
        
        private int sequenceOrderField;
        
        private bool latestInSessionField;
        
        private System.DateTime dateTimeUtcField;
        
        private bool processedField;
        
        private bool submittedWhenRegisteringField;
        
        private System.Nullable<bool> isVerifiedField;
        
        private System.Nullable<bool> useForTrainingInTestField;
        
        private System.Nullable<bool> useForEvaluationInTestField;
        
        private string commentsField;
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=0)]
        public System.Guid Id {
            get {
                return this.idField;
            }
            set {
                this.idField = value;
                this.RaisePropertyChanged("Id");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=1)]
        public System.Guid SessionId {
            get {
                return this.sessionIdField;
            }
            set {
                this.sessionIdField = value;
                this.RaisePropertyChanged("SessionId");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=2)]
        public string Email {
            get {
                return this.emailField;
            }
            set {
                this.emailField = value;
                this.RaisePropertyChanged("Email");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(DataType="base64Binary", Order=3)]
        public byte[] Face {
            get {
                return this.faceField;
            }
            set {
                this.faceField = value;
                this.RaisePropertyChanged("Face");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=4)]
        public int FaceWidth {
            get {
                return this.faceWidthField;
            }
            set {
                this.faceWidthField = value;
                this.RaisePropertyChanged("FaceWidth");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(DataType="base64Binary", Order=5)]
        public byte[] SnapshotJpeg {
            get {
                return this.snapshotJpegField;
            }
            set {
                this.snapshotJpegField = value;
                this.RaisePropertyChanged("SnapshotJpeg");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=6)]
        public string ClientIpAddress {
            get {
                return this.clientIpAddressField;
            }
            set {
                this.clientIpAddressField = value;
                this.RaisePropertyChanged("ClientIpAddress");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=7)]
        public int SequenceOrder {
            get {
                return this.sequenceOrderField;
            }
            set {
                this.sequenceOrderField = value;
                this.RaisePropertyChanged("SequenceOrder");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=8)]
        public bool LatestInSession {
            get {
                return this.latestInSessionField;
            }
            set {
                this.latestInSessionField = value;
                this.RaisePropertyChanged("LatestInSession");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=9)]
        public System.DateTime DateTimeUtc {
            get {
                return this.dateTimeUtcField;
            }
            set {
                this.dateTimeUtcField = value;
                this.RaisePropertyChanged("DateTimeUtc");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=10)]
        public bool Processed {
            get {
                return this.processedField;
            }
            set {
                this.processedField = value;
                this.RaisePropertyChanged("Processed");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=11)]
        public bool SubmittedWhenRegistering {
            get {
                return this.submittedWhenRegisteringField;
            }
            set {
                this.submittedWhenRegisteringField = value;
                this.RaisePropertyChanged("SubmittedWhenRegistering");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(IsNullable=true, Order=12)]
        public System.Nullable<bool> IsVerified {
            get {
                return this.isVerifiedField;
            }
            set {
                this.isVerifiedField = value;
                this.RaisePropertyChanged("IsVerified");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(IsNullable=true, Order=13)]
        public System.Nullable<bool> UseForTrainingInTest {
            get {
                return this.useForTrainingInTestField;
            }
            set {
                this.useForTrainingInTestField = value;
                this.RaisePropertyChanged("UseForTrainingInTest");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(IsNullable=true, Order=14)]
        public System.Nullable<bool> UseForEvaluationInTest {
            get {
                return this.useForEvaluationInTestField;
            }
            set {
                this.useForEvaluationInTestField = value;
                this.RaisePropertyChanged("UseForEvaluationInTest");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=15)]
        public string Comments {
            get {
                return this.commentsField;
            }
            set {
                this.commentsField = value;
                this.RaisePropertyChanged("Comments");
            }
        }
    }
    
    /// <remarks/>
    [System.Xml.Serialization.XmlIncludeAttribute(typeof(FacesForTraining))]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.Xml", "4.0.30319.225")]
    [System.SerializableAttribute()]
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.ComponentModel.DesignerCategoryAttribute("code")]
    [System.Xml.Serialization.XmlTypeAttribute(Namespace="http://tempuri.org/")]
    public abstract partial class EntityObject : StructuralObject {
        
        private EntityKey entityKeyField;
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=0)]
        public EntityKey EntityKey {
            get {
                return this.entityKeyField;
            }
            set {
                this.entityKeyField = value;
                this.RaisePropertyChanged("EntityKey");
            }
        }
    }
    
    /// <remarks/>
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.Xml", "4.0.30319.225")]
    [System.SerializableAttribute()]
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.ComponentModel.DesignerCategoryAttribute("code")]
    [System.Xml.Serialization.XmlTypeAttribute(Namespace="http://tempuri.org/")]
    public partial class EntityKey : object, System.ComponentModel.INotifyPropertyChanged {
        
        private string entitySetNameField;
        
        private string entityContainerNameField;
        
        private EntityKeyMember[] entityKeyValuesField;
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=0)]
        public string EntitySetName {
            get {
                return this.entitySetNameField;
            }
            set {
                this.entitySetNameField = value;
                this.RaisePropertyChanged("EntitySetName");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=1)]
        public string EntityContainerName {
            get {
                return this.entityContainerNameField;
            }
            set {
                this.entityContainerNameField = value;
                this.RaisePropertyChanged("EntityContainerName");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlArrayAttribute(Order=2)]
        public EntityKeyMember[] EntityKeyValues {
            get {
                return this.entityKeyValuesField;
            }
            set {
                this.entityKeyValuesField = value;
                this.RaisePropertyChanged("EntityKeyValues");
            }
        }
        
        public event System.ComponentModel.PropertyChangedEventHandler PropertyChanged;
        
        protected void RaisePropertyChanged(string propertyName) {
            System.ComponentModel.PropertyChangedEventHandler propertyChanged = this.PropertyChanged;
            if ((propertyChanged != null)) {
                propertyChanged(this, new System.ComponentModel.PropertyChangedEventArgs(propertyName));
            }
        }
    }
    
    /// <remarks/>
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.Xml", "4.0.30319.225")]
    [System.SerializableAttribute()]
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.ComponentModel.DesignerCategoryAttribute("code")]
    [System.Xml.Serialization.XmlTypeAttribute(Namespace="http://tempuri.org/")]
    public partial class EntityKeyMember : object, System.ComponentModel.INotifyPropertyChanged {
        
        private string keyField;
        
        private object valueField;
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=0)]
        public string Key {
            get {
                return this.keyField;
            }
            set {
                this.keyField = value;
                this.RaisePropertyChanged("Key");
            }
        }
        
        /// <remarks/>
        [System.Xml.Serialization.XmlElementAttribute(Order=1)]
        public object Value {
            get {
                return this.valueField;
            }
            set {
                this.valueField = value;
                this.RaisePropertyChanged("Value");
            }
        }
        
        public event System.ComponentModel.PropertyChangedEventHandler PropertyChanged;
        
        protected void RaisePropertyChanged(string propertyName) {
            System.ComponentModel.PropertyChangedEventHandler propertyChanged = this.PropertyChanged;
            if ((propertyChanged != null)) {
                propertyChanged(this, new System.ComponentModel.PropertyChangedEventArgs(propertyName));
            }
        }
    }
    
    /// <remarks/>
    [System.Xml.Serialization.XmlIncludeAttribute(typeof(EntityObject))]
    [System.Xml.Serialization.XmlIncludeAttribute(typeof(FacesForTraining))]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.Xml", "4.0.30319.225")]
    [System.SerializableAttribute()]
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.ComponentModel.DesignerCategoryAttribute("code")]
    [System.Xml.Serialization.XmlTypeAttribute(Namespace="http://tempuri.org/")]
    public abstract partial class StructuralObject : object, System.ComponentModel.INotifyPropertyChanged {
        
        public event System.ComponentModel.PropertyChangedEventHandler PropertyChanged;
        
        protected void RaisePropertyChanged(string propertyName) {
            System.ComponentModel.PropertyChangedEventHandler propertyChanged = this.PropertyChanged;
            if ((propertyChanged != null)) {
                propertyChanged(this, new System.ComponentModel.PropertyChangedEventArgs(propertyName));
            }
        }
    }
    
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Advanced)]
    [System.ServiceModel.MessageContractAttribute(WrapperName="Recognize", WrapperNamespace="http://tempuri.org/", IsWrapped=true)]
    public partial class RecognizeRequest {
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=0)]
        public string token;
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=1)]
        public string email;
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=2)]
        [System.Xml.Serialization.XmlElementAttribute(DataType="base64Binary")]
        public byte[] jpegData;
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=3)]
        public System.Guid sessionId;
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=4)]
        public int sequenceOrder;
        
        public RecognizeRequest() {
        }
        
        public RecognizeRequest(string token, string email, byte[] jpegData, System.Guid sessionId, int sequenceOrder) {
            this.token = token;
            this.email = email;
            this.jpegData = jpegData;
            this.sessionId = sessionId;
            this.sequenceOrder = sequenceOrder;
        }
    }
    
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Advanced)]
    [System.ServiceModel.MessageContractAttribute(WrapperName="RecognizeResponse", WrapperNamespace="http://tempuri.org/", IsWrapped=true)]
    public partial class RecognizeResponse {
        
        [System.ServiceModel.MessageBodyMemberAttribute(Namespace="http://tempuri.org/", Order=0)]
        public double confidence;
        
        public RecognizeResponse() {
        }
        
        public RecognizeResponse(double confidence) {
            this.confidence = confidence;
        }
    }
    
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public interface FaceRecognitionServiceSoapChannel : StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FaceRecognitionServiceSoap, System.ServiceModel.IClientChannel {
    }
    
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public partial class FaceRecognitionServiceSoapClient : System.ServiceModel.ClientBase<StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FaceRecognitionServiceSoap>, StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FaceRecognitionServiceSoap {
        
        public FaceRecognitionServiceSoapClient() {
        }
        
        public FaceRecognitionServiceSoapClient(string endpointConfigurationName) : 
                base(endpointConfigurationName) {
        }
        
        public FaceRecognitionServiceSoapClient(string endpointConfigurationName, string remoteAddress) : 
                base(endpointConfigurationName, remoteAddress) {
        }
        
        public FaceRecognitionServiceSoapClient(string endpointConfigurationName, System.ServiceModel.EndpointAddress remoteAddress) : 
                base(endpointConfigurationName, remoteAddress) {
        }
        
        public FaceRecognitionServiceSoapClient(System.ServiceModel.Channels.Binding binding, System.ServiceModel.EndpointAddress remoteAddress) : 
                base(binding, remoteAddress) {
        }
        
        public string VerifyAppIdAndGetToken(string appId, string password) {
            return base.Channel.VerifyAppIdAndGetToken(appId, password);
        }
        
        public double SubmitFaceForTraining(out string errorMessage, out bool isReadyForLogin, out string messageForUser, string token, StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FacesForTraining face) {
            return base.Channel.SubmitFaceForTraining(out errorMessage, out isReadyForLogin, out messageForUser, token, face);
        }
        
        public string GetLoginData(out bool requiresServerSideRecognition, string token, string email) {
            return base.Channel.GetLoginData(out requiresServerSideRecognition, token, email);
        }
        
        public void DeleteLoginData(string token, string email) {
            base.Channel.DeleteLoginData(token, email);
        }
        
        public string GetLoggedInUser(string token) {
            return base.Channel.GetLoggedInUser(token);
        }
        
        [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Advanced)]
        StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeResponse StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FaceRecognitionServiceSoap.Recognize(StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeRequest request) {
            return base.Channel.Recognize(request);
        }
        
        public double Recognize(string token, string email, byte[] jpegData, System.Guid sessionId, int sequenceOrder) {
            StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeRequest inValue = new StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeRequest();
            inValue.token = token;
            inValue.email = email;
            inValue.jpegData = jpegData;
            inValue.sessionId = sessionId;
            inValue.sequenceOrder = sequenceOrder;
            StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.RecognizeResponse retVal = ((StarTrinity.FaceRecognition.SL.Sample.Web.FaceRecognitionServiceReference.FaceRecognitionServiceSoap)(this)).Recognize(inValue);
            return retVal.confidence;
        }
    }
}
